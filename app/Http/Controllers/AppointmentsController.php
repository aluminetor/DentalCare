<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentsController extends Controller
{
    private function getPatients()
    {
        return Patient::orderBy('last_name', 'asc')
            ->orderBy('first_name', 'asc')
            ->get();
    }

    private function getDentists()
    {
        $roleId = Role::where('name', 'Dentist')->value('id');

        if (!$roleId) {
            return collect();
        }

        return User::where('role_id', $roleId)
            ->orderBy('name', 'asc')
            ->get();
    }

    private function validationRules(): array
    {
        $roleId = Role::where('name', 'Dentist')->value('id');

        $dentistRules = [
            'required',
            'integer',
            'exists:users,id',
        ];

        if ($roleId) {
            $dentistRules[] = Rule::in(
                User::where('role_id', $roleId)->pluck('id')->all()
            );
        } else {
            $dentistRules[] = Rule::in([]);
        }

        return [
            'patient_id' => [
                'required',
                'integer',
                'exists:patients,id',
            ],
            'dentist_id' => $dentistRules,
            'date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'time' => [
                'required',
                'date_format:H:i',
            ],
            'reason' => [
                'required',
                'string',
                'max:200',
            ],
            'status' => [
                'required',
                Rule::in([
                    'Pending',
                    'Confirmed',
                    'Completed',
                    'Cancelled',
                ]),
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ];
    }

    private function validationMessages(): array
    {
        return [
            'patient_id.required' => 'You must select a patient.',
            'patient_id.exists' => 'The selected patient does not exist.',
            'dentist_id.required' => 'You must select a dentist.',
            'dentist_id.in' => 'The selected user does not have the Dentist role.',
            'dentist_id.exists' => 'The selected dentist does not exist.',
            'date.required' => 'You must select a date.',
            'date.after_or_equal' => 'The appointment date cannot be earlier than today.',
            'time.required' => 'You must select a time.',
            'time.date_format' => 'The selected time does not have a valid format.',
            'reason.required' => 'You must indicate the reason for the appointment.',
            'reason.max' => 'The reason cannot exceed 200 characters.',
            'status.required' => 'You must select a valid status.',
            'status.in' => 'The selected status is not valid.',
        ];
    }

    private function isDentist(): bool
    {
        return auth()->user()?->role?->name === 'Dentist';
    }

    private function authorizeAppointment(Appointment $appointment): void
    {
        if (
            $this->isDentist()
            && (int) $appointment->dentist_id !== (int) auth()->id()
        ) {
            abort(403, 'You do not have permission to access this appointment.');
        }
    }

    private function hasConflict(array $data, ?int $ignoreId = null): bool
    {
        // Cancelled appointments do not block the time slot.
        if ($data['status'] === 'Cancelled') {
            return false;
        }

        $query = Appointment::where('dentist_id', $data['dentist_id'])
            ->where('date', $data['date'])
            ->whereTime('time', $data['time'])
            ->where('status', '!=', 'Cancelled');

        if ($ignoreId !== null) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }

    public function index(Request $request)
    {
        if (!empty($request->records_per_page)) {
            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE', 50)
                                            ? $request->records_per_page
                                            : env('PAGINATION_MAX_SIZE', 50);
        } else {
            $request->records_per_page = env('PAGINATION_DEFAULT', 15);
        }

        $query = Appointment::with(['patient', 'dentist']);

        if ($this->isDentist()) {
            $query->where('dentist_id', auth()->id());
        }

        if (!empty($request->filter)) {
            $filter = $request->filter;
            $query->where(function ($q) use ($filter) {
                $q->where('reason', 'LIKE', "%$filter%")
                  ->orWhere('status', 'LIKE', "%$filter%")
                  ->orWhere('date', 'LIKE', "%$filter%")
                  ->orWhereHas('patient', function ($subQuery) use ($filter) {
                      $subQuery->where('first_name', 'LIKE', "%$filter%")
                               ->orWhere('last_name', 'LIKE', "%$filter%")
                               ->orWhere('document', 'LIKE', "%$filter%");
                  })
                  ->orWhereHas('dentist', function ($subQuery) use ($filter) {
                      $subQuery->where('name', 'LIKE', "%$filter%")
                               ->orWhere('last_name', 'LIKE', "%$filter%");
                  });
            });
        }

        $appointments = $query
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate($request->records_per_page);

        return view('appointments.index', [
            'appointments' => $appointments,
            'data' => $request,
        ]);
    }

    public function create()
    {
        $patients = $this->getPatients();
        $dentists = $this->getDentists();

        return view('appointments.create', compact('patients', 'dentists'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            $this->validationRules(),
            $this->validationMessages()
        );

        if ($this->hasConflict($data)) {
            return back()
                ->withErrors([
                    'time' => 'This dentist already has an active appointment at that date and time. Please select another time slot.',
                ])
                ->withInput();
        }

        Appointment::create($data);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'The appointment has been created successfully.');
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);

        $this->authorizeAppointment($appointment);

        $patients = $this->getPatients();
        $dentists = $this->getDentists();

        return view('appointments.edit', compact(
            'appointment',
            'patients',
            'dentists'
        ));
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $this->authorizeAppointment($appointment);

        $data = $request->validate(
            $this->validationRules(),
            $this->validationMessages()
        );

        if ($this->hasConflict($data, $appointment->id)) {
            return back()
                ->withErrors([
                    'time' => 'This dentist already has another active appointment at that date and time. Please select another time slot.',
                ])
                ->withInput();
        }

        $appointment->update($data);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'The appointment has been updated successfully.');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);

        $this->authorizeAppointment($appointment);

        $appointment->delete();

        return redirect()
            ->route('appointments.index')
            ->with('success', 'The appointment has been deleted successfully.');
    }
}
