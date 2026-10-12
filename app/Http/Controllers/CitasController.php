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

        $reglasOdontologo = ['required', 'integer', 'exists:users,id'];

        if ($rolId) {
            $reglasOdontologo[] = Rule::in(
                User::where('rol_id', $rolId)->pluck('id')->all()
            );
        } else {
            $reglasOdontologo[] = Rule::in([]);
        }

        return [
            'paciente_id' => ['required', 'integer', 'exists:pacientes,id'],
            'odontologo_id' => $reglasOdontologo,
            'fecha' => ['required', 'date'],
            'hora' => ['required', 'date_format:H:i'],
            'motivo' => ['required', 'string', 'max:200'],
            'estado' => [
                'required',
                Rule::in(['Pendiente', 'Confirmada', 'Atendida', 'Cancelada']),
            ],
            'observaciones' => ['nullable', 'string'],
        ];
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
        $datos = $request->validate($this->reglasValidacion());

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

        return view('citas.edit', compact('cita', 'pacientes', 'odontologos'));
    }

    public function update(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);

        $datos = $request->validate($this->reglasValidacion());

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