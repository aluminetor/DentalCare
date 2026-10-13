<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(
        Request $request,
        Closure $next,
        string $permiso
    ): Response {
        $usuario = $request->user();

        if (!$usuario) {
            return redirect()->route('login');
        }

        $rol = $usuario->rol;

        if (!$rol) {
            abort(403, 'Tu usuario no tiene un rol asignado.');
        }

        $tienePermiso = $rol->permisos()
            ->where('codigo', $permiso)
            ->exists();

        if (!$tienePermiso) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        return $next($request);
    }
}