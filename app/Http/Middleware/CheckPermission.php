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
        string $permission
    ): Response {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $role = $user->role;

        if (!$role) {
            abort(403, 'Your user does not have an assigned role.');
        }

        $hasPermission = $role->permissions()
            ->where('code', $permission)
            ->exists();

        if (!$hasPermission) {
            abort(403, 'You do not have permission to perform this action.');
        }

        return $next($request);
    }
}
