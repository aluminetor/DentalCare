<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

/**
 * Patients CRUD. Reference module: Appointments, Users, and Roles
 * follow this same structure (index, create, edit, store, update, delete).
 */
class PatientsController extends Controller
{
    // List patients
    public function index(Request $request)
    {
        if (!empty($request->records_per_page)) {
            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE', 50)
                                            ? $request->records_per_page
                                            : env('PAGINATION_MAX_SIZE', 50);
        } else {
            $request->records_per_page = env('PAGINATION_DEFAULT', 15);
        }

        $patients = Patient::where(function ($query) use ($request) {
                $query->where('first_name', 'LIKE', "%$request->filter%")
                      ->orWhere('last_name', 'LIKE', "%$request->filter%")
                      ->orWhere('document', 'LIKE', "%$request->filter%")
                      ->orWhere('phone', 'LIKE', "%$request->filter%");
            })
            ->orderBy('last_name', 'asc')
            ->orderBy('first_name', 'asc')
            ->paginate($request->records_per_page);

        return view('patients/index', ['patients' => $patients, 'data' => $request]);
    }

    // Show empty form
    public function create()
    {
        return view('patients/create');
    }

    // Show form with patient data
    public function edit($id)
    {
        $patient = Patient::find($id);

        if (empty($patient)) {
            Session::flash('message', ['content' => "The patient with id '$id' does not exist.", 'type' => 'error']);
            return redirect()->route('patients.index');
        }

        return view('patients/edit', ['patient' => $patient]);
    }

    // Store new patient
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'first_name' => 'required|max:60',
            'last_name' => 'required|max:60',
            'document' => 'required|max:20|unique:patients,document',
            'phone' => 'required|max:20',
            'birth_date' => 'required|date|before_or_equal:today',
        ], [
            'first_name.required' => 'The first name is required.',
            'first_name.max' => 'The first name may not be greater than :max characters.',

            'last_name.required' => 'The last name is required.',
            'last_name.max' => 'The last name may not be greater than :max characters.',

            'document.required' => 'The document is required.',
            'document.max' => 'The document may not be greater than :max characters.',
            'document.unique' => 'A patient with this document already exists.',

            'phone.required' => 'The phone number is required.',
            'phone.max' => 'The phone number may not be greater than :max characters.',

            'birth_date.required' => 'The birth date is required.',
            'birth_date.date' => 'The birth date is not a valid date.',
            'birth_date.before_or_equal' => 'The birth date cannot be in the future.',
        ])->validate();

        try {
            $patient = new Patient();
            $patient->first_name = $request->first_name;
            $patient->last_name = $request->last_name;
            $patient->document = $request->document;
            $patient->phone = $request->phone;
            $patient->birth_date = $request->birth_date;
            $patient->save();

            Session::flash('message', ['content' => 'Patient created successfully.', 'type' => 'success']);
            return redirect()->route('patients.index');
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'An unexpected error has occurred.', 'type' => 'error']);
            return redirect()->back()->withInput();
        }
    }

    // Update existing patient
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'first_name' => 'required|max:60',
            'last_name' => 'required|max:60',
            'document' => 'required|max:20|unique:patients,document,' . $request->patient_id,
            'phone' => 'required|max:20',
            'birth_date' => 'required|date|before_or_equal:today',
        ], [
            'patient_id.required' => 'The patient is required.',
            'patient_id.exists' => 'The selected patient id does not exist.',

            'first_name.required' => 'The first name is required.',
            'first_name.max' => 'The first name may not be greater than :max characters.',

            'last_name.required' => 'The last name is required.',
            'last_name.max' => 'The last name may not be greater than :max characters.',

            'document.required' => 'The document is required.',
            'document.max' => 'The document may not be greater than :max characters.',
            'document.unique' => 'A patient with this document already exists.',

            'phone.required' => 'The phone number is required.',
            'phone.max' => 'The phone number may not be greater than :max characters.',

            'birth_date.required' => 'The birth date is required.',
            'birth_date.date' => 'The birth date is not a valid date.',
            'birth_date.before_or_equal' => 'The birth date cannot be in the future.',
        ])->validate();

        try {
            $patient = Patient::find($request->patient_id);
            $patient->first_name = $request->first_name;
            $patient->last_name = $request->last_name;
            $patient->document = $request->document;
            $patient->phone = $request->phone;
            $patient->birth_date = $request->birth_date;
            $patient->save();

            Session::flash('message', ['content' => 'Patient updated successfully.', 'type' => 'success']);
            return redirect()->route('patients.index');
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'An unexpected error has occurred.', 'type' => 'error']);
            return redirect()->back()->withInput();
        }
    }

    // Delete patient
    public function delete($id)
    {
        try {
            $patient = Patient::find($id);

            if (empty($patient)) {
                Session::flash('message', ['content' => "The patient with id '$id' does not exist.", 'type' => 'error']);
                return redirect()->route('patients.index');
            }

            // Business rule: cannot delete a patient with registered appointments
            if ($patient->appointments()->exists()) {
                Session::flash('message', ['content' => 'Cannot delete: the patient has registered appointments.', 'type' => 'error']);
                return redirect()->route('patients.index');
            }

            $patient->delete();

            Session::flash('message', ['content' => 'Patient deleted successfully.', 'type' => 'success']);
            return redirect()->route('patients.index');
        } catch (Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'An unexpected error has occurred.', 'type' => 'error']);
            return redirect()->back();
        }
    }
}
