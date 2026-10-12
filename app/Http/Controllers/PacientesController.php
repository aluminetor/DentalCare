<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

/**
 * CRUD de pacientes. Es el módulo de REFERENCIA: Citas, Usuarios y Roles
 * se hacen con esta misma estructura (index, create, edit, store, update, delete).
 */
class PacientesController extends Controller
{
    // Listar
    public function index() {

        $pacientes = Paciente::orderBy('apellido')->orderBy('nombre')->get();

        return view('pacientes/index', [ 'pacientes' => $pacientes ]);
    }

    // Mostrar el formulario vacío
    public function create() {

        return view('pacientes/create');
    }

    // Mostrar el formulario con los datos del paciente
    public function edit($id) {

        $paciente = Paciente::find($id);

        if (empty($paciente)) {

            Session::flash('message', [ 'content' => "El paciente con id '$id' no existe.", 'type' => 'error' ]);
            return redirect()->route('pacientes.index');
        }

        return view('pacientes/edit', [ 'paciente' => $paciente ]);
    }

    // Guardar uno nuevo
    public function store(Request $request) {

        Validator::make($request->all(),
        [
            'nombre' => 'required|max:60',
            'apellido' => 'required|max:60',
            'documento' => 'required|max:20|unique:pacientes,documento',
            'telefono' => 'required|max:20',
            'fecha_nacimiento' => 'required|date|before_or_equal:today',
        ],
        [
            'nombre.required' => 'El nombre es requerido',
            'nombre.max' => 'El nombre no puede tener más de :max caracteres',

            'apellido.required' => 'El apellido es requerido',
            'apellido.max' => 'El apellido no puede tener más de :max caracteres',

            'documento.required' => 'El documento es requerido',
            'documento.max' => 'El documento no puede tener más de :max caracteres',
            'documento.unique' => 'Ya existe un paciente con ese documento',

            'telefono.required' => 'El teléfono es requerido',
            'telefono.max' => 'El teléfono no puede tener más de :max caracteres',

            'fecha_nacimiento.required' => 'La fecha de nacimiento es requerida',
            'fecha_nacimiento.date' => 'La fecha de nacimiento no es válida',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento no puede ser futura',
        ])->validate();

        try {

            $paciente = new Paciente();
            $paciente->nombre = $request->nombre;
            $paciente->apellido = $request->apellido;
            $paciente->documento = $request->documento;
            $paciente->telefono = $request->telefono;
            $paciente->fecha_nacimiento = $request->fecha_nacimiento;
            $paciente->save();

            Session::flash('message', [ 'content' => "Paciente creado con éxito", 'type' => 'success' ]);
            return redirect()->route('pacientes.index');

        } catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', [ 'content' => "Ha ocurrido un error.", 'type' => 'error' ]);
            return redirect()->back()->withInput();
        }
    }

    // Guardar los cambios de uno existente
    public function update(Request $request) {

        Validator::make($request->all(),
        [
            'paciente_id' => 'required|exists:pacientes,id',
            'nombre' => 'required|max:60',
            'apellido' => 'required|max:60',
            'documento' => 'required|max:20|unique:pacientes,documento,' . $request->paciente_id,
            'telefono' => 'required|max:20',
            'fecha_nacimiento' => 'required|date|before_or_equal:today',
        ],
        [
            'paciente_id.required' => 'El paciente es requerido',
            'paciente_id.exists' => 'El id dado no existe',

            'nombre.required' => 'El nombre es requerido',
            'nombre.max' => 'El nombre no puede tener más de :max caracteres',

            'apellido.required' => 'El apellido es requerido',
            'apellido.max' => 'El apellido no puede tener más de :max caracteres',

            'documento.required' => 'El documento es requerido',
            'documento.max' => 'El documento no puede tener más de :max caracteres',
            'documento.unique' => 'Ya existe un paciente con ese documento',

            'telefono.required' => 'El teléfono es requerido',
            'telefono.max' => 'El teléfono no puede tener más de :max caracteres',

            'fecha_nacimiento.required' => 'La fecha de nacimiento es requerida',
            'fecha_nacimiento.date' => 'La fecha de nacimiento no es válida',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento no puede ser futura',
        ])->validate();

        try {

            $paciente = Paciente::find($request->paciente_id);
            $paciente->nombre = $request->nombre;
            $paciente->apellido = $request->apellido;
            $paciente->documento = $request->documento;
            $paciente->telefono = $request->telefono;
            $paciente->fecha_nacimiento = $request->fecha_nacimiento;
            $paciente->save();

            Session::flash('message', [ 'content' => "Paciente actualizado con éxito", 'type' => 'success' ]);
            return redirect()->route('pacientes.index');

        } catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', [ 'content' => "Ha ocurrido un error.", 'type' => 'error' ]);
            return redirect()->back()->withInput();
        }
    }

    // Eliminar
    public function delete($id) {

        try {

            $paciente = Paciente::find($id);

            if (empty($paciente)) {

                Session::flash('message', [ 'content' => "El paciente con id '$id' no existe.", 'type' => 'error' ]);
                return redirect()->route('pacientes.index');
            }

            // Regla de negocio: no se elimina un paciente que tenga citas
            if ($paciente->citas()->exists()) {

                Session::flash('message', [ 'content' => "No se puede eliminar: el paciente tiene citas registradas.", 'type' => 'error' ]);
                return redirect()->route('pacientes.index');
            }

            $paciente->delete();

            Session::flash('message', [ 'content' => "Paciente eliminado con éxito", 'type' => 'success' ]);
            return redirect()->route('pacientes.index');

        } catch(Exception $ex) {

            Log::error($ex);
            Session::flash('message', [ 'content' => "Ha ocurrido un error.", 'type' => 'error' ]);
            return redirect()->back();
        }
    }
}
