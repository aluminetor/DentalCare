<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuariosController extends Controller
{
    // Reglas comunes de crear y editar. Los máximos coinciden con el largo de cada columna de la tabla users.
    private function reglasBase(): array
    {
        return [
            'name' => ['required', 'string', 'max:60'],
            'apellido' => ['required', 'string', 'max:60'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'especialidad' => ['nullable', 'string', 'max:80'],
            'rol_id' => ['required', 'integer', 'exists:roles,id'],
        ];
    }

    private function mensajes(): array
    {
        return [
            'name.required' => 'El nombre es requerido.',
            'name.max' => 'El nombre no puede tener más de :max caracteres.',
            'apellido.required' => 'El apellido es requerido.',
            'apellido.max' => 'El apellido no puede tener más de :max caracteres.',
            'email.required' => 'El correo es requerido.',
            'email.email' => 'El correo no tiene un formato válido.',
            'email.max' => 'El correo no puede tener más de :max caracteres.',
            'email.unique' => 'Ya existe un usuario con ese correo.',
            'telefono.max' => 'El teléfono no puede tener más de :max caracteres.',
            'especialidad.max' => 'La especialidad no puede tener más de :max caracteres.',
            'rol_id.required' => 'Debes seleccionar un rol.',
            'rol_id.exists' => 'El rol seleccionado no existe.',
            'password.required' => 'La contraseña es requerida.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ];
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

        $usuarios = User::with('rol')
            ->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', "%$request->filter%")
                      ->orWhere('apellido', 'LIKE', "%$request->filter%")
                      ->orWhere('email', 'LIKE', "%$request->filter%")
                      ->orWhere('especialidad', 'LIKE', "%$request->filter%")
                      ->orWhereHas('rol', function ($q) use ($request) {
                          $q->where('nombre', 'LIKE', "%$request->filter%");
                      });
            })
            ->orderBy('name', 'asc')
            ->paginate($request->records_per_page);

        return view('usuarios.index', [
            'usuarios' => $usuarios,
            'data' => $request,
        ]);
    }

    public function create()
    {
        $roles = Rol::orderBy('nombre', 'asc')->get();

        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate($this->reglasBase() + [
            'email' => ['required', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $this->mensajes());

        User::create([
            'name' => $datos['name'],
            'apellido' => $datos['apellido'],
            'email' => $datos['email'],
            'telefono' => $datos['telefono'] ?? null,
            'especialidad' => $datos['especialidad'] ?? null,
            'rol_id' => $datos['rol_id'],
            'password' => Hash::make($datos['password']),
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    // Se busca por id dentro del método (no con route-model binding) para que el permiso
    // se valide ANTES: así, sin permiso siempre es 403, exista o no el usuario.
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Rol::orderBy('nombre', 'asc')->get();

        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $datos = $request->validate($this->reglasBase() + [
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($usuario->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], $this->mensajes());

        $usuario->name = $datos['name'];
        $usuario->apellido = $datos['apellido'];
        $usuario->email = $datos['email'];
        $usuario->telefono = $datos['telefono'] ?? null;
        $usuario->especialidad = $datos['especialidad'] ?? null;
        $usuario->rol_id = $datos['rol_id'];

        if (!empty($datos['password'])) {
            $usuario->password = Hash::make($datos['password']);
        }

        $usuario->save();

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        if ($usuario->id === auth()->id()) {
            return back()->with(
                'error',
                'No puedes eliminar tu propia cuenta mientras tienes la sesión iniciada.'
            );
        }

        if ($usuario->citas()->exists()) {
            return back()->with(
                'error',
                'No puedes eliminar un usuario que tiene citas asignadas.'
            );
        }

        $usuario->delete();

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}