<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CitasController extends Controller
{
    private function obtenerPacientes()
    {
        return Paciente::orderBy('apellido', 'asc')
            ->orderBy('nombre', 'asc')
            ->get();
    }

    private function obtenerOdontologos()
    {
        $rolId = Rol::where('nombre', 'Odontólogo')->value('id');

        if (!$rolId) {
            return collect();
        }

        return User::where('rol_id', $rolId)
            ->orderBy('name', 'asc')
            ->get();
    }

    private function reglasValidacion(): array
    {
        $rolId = Rol::where('nombre', 'Odontólogo')->value('id');

        $reglasOdontologo = [
            'required',
            'integer',
            'exists:users,id',
        ];

        if ($rolId) {
            $reglasOdontologo[] = Rule::in(
                User::where('rol_id', $rolId)->pluck('id')->all()
            );
        } else {
            $reglasOdontologo[] = Rule::in([]);
        }

        return [
            'paciente_id' => [
                'required',
                'integer',
                'exists:pacientes,id',
            ],
            'odontologo_id' => $reglasOdontologo,
            'fecha' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'hora' => [
                'required',
                'date_format:H:i',
            ],
            'motivo' => [
                'required',
                'string',
                'max:200',
            ],
            'estado' => [
                'required',
                Rule::in([
                    'Pendiente',
                    'Confirmada',
                    'Atendida',
                    'Cancelada',
                ]),
            ],
            'observaciones' => [
                'nullable',
                'string',
            ],
        ];
    }

    private function mensajesValidacion(): array
    {
        return [
            'paciente_id.required' =>
                'Debes seleccionar un paciente.',
            'paciente_id.exists' =>
                'El paciente seleccionado no existe.',
            'odontologo_id.required' =>
                'Debes seleccionar un odontólogo.',
            'odontologo_id.in' =>
                'El usuario seleccionado no tiene el rol de odontólogo.',
            'odontologo_id.exists' =>
                'El odontólogo seleccionado no existe.',
            'fecha.required' =>
                'Debes seleccionar una fecha.',
            'fecha.after_or_equal' =>
                'La fecha de la cita no puede ser anterior a hoy.',
            'hora.required' =>
                'Debes seleccionar una hora.',
            'hora.date_format' =>
                'La hora seleccionada no tiene un formato válido.',
            'motivo.required' =>
                'Debes indicar el motivo de la cita.',
            'motivo.max' =>
                'El motivo no puede superar los 200 caracteres.',
            'estado.required' =>
                'Debes seleccionar un estado válido.',
            'estado.in' =>
                'El estado seleccionado no es válido.',
        ];
    }

    private function existeConflicto(array $datos, ?int $ignorarId = null): bool
    {
        // Las citas canceladas no ocupan el horario.
        if ($datos['estado'] === 'Cancelada') {
            return false;
        }

        $consulta = Cita::where('odontologo_id', $datos['odontologo_id'])
            ->where('fecha', $datos['fecha'])
            ->whereTime('hora', $datos['hora'])
            ->where('estado', '!=', 'Cancelada');

        if ($ignorarId !== null) {
            $consulta->where('id', '!=', $ignorarId);
        }

        return $consulta->exists();
    }

    public function index()
    {
        $citas = Cita::with(['paciente', 'odontologo'])
            ->orderBy('fecha', 'desc')
            ->orderBy('hora', 'desc')
            ->get();

        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        $pacientes = $this->obtenerPacientes();
        $odontologos = $this->obtenerOdontologos();

        return view('citas.create', compact('pacientes', 'odontologos'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate(
            $this->reglasValidacion(),
            $this->mensajesValidacion()
        );

        if ($this->existeConflicto($datos)) {
            return back()
                ->withErrors([
                    'hora' => 'Este odontólogo ya tiene una cita activa en esa fecha y hora. Selecciona otro horario.',
                ])
                ->withInput();
        }

        Cita::create($datos);

        return redirect()
            ->route('citas.index')
            ->with('success', 'La cita se ha creado correctamente.');
    }

    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        $pacientes = $this->obtenerPacientes();
        $odontologos = $this->obtenerOdontologos();

        return view('citas.edit', compact(
            'cita',
            'pacientes',
            'odontologos'
        ));
    }

    public function update(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);

        $datos = $request->validate(
            $this->reglasValidacion(),
            $this->mensajesValidacion()
        );

        if ($this->existeConflicto($datos, $cita->id)) {
            return back()
                ->withErrors([
                    'hora' => 'Este odontólogo ya tiene otra cita activa en esa fecha y hora. Selecciona otro horario.',
                ])
                ->withInput();
        }

        $cita->update($datos);

        return redirect()
            ->route('citas.index')
            ->with('success', 'La cita se ha actualizado correctamente.');
    }

    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()
            ->route('citas.index')
            ->with('success', 'La cita se ha eliminado correctamente.');
    }
}