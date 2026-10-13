<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::with('rol')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Rol::orderBy('nombre', 'asc')->get();

        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'especialidad' => ['nullable', 'string', 'max:255'],
            'rol_id' => ['required', 'integer', 'exists:roles,id'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $datos['name'],
            'apellido' => $datos['apellido'] ?? null,
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

    public function edit(User $usuario)
    {
        $roles = Rol::orderBy('nombre', 'asc')->get();

        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, User $usuario)
    {
        $datos = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['nullable', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($usuario->id),
            ],
            'telefono' => ['nullable', 'string', 'max:30'],
            'especialidad' => ['nullable', 'string', 'max:255'],
            'rol_id' => ['required', 'integer', 'exists:roles,id'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $usuario->name = $datos['name'];
        $usuario->apellido = $datos['apellido'] ?? null;
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

    public function destroy(User $usuario)
    {
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