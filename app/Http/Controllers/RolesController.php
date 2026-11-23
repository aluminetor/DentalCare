<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RolesController extends Controller
{
    /**
     * List all roles with search and pagination.
     */
    public function index(Request $request)
    {
        $perPage = min(
            max((int) $request->input('records_per_page', 15), 1),
            50
        );

        $filter = $request->input('filter', '');

        $roles = Role::withCount(['users', 'permissions'])
            ->where(function ($query) use ($filter) {
                $query->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%");
            })
            ->orderBy('name')
            ->paginate($perPage)
            ->withQueryString();

        return view('roles.index', [
            'roles' => $roles,
            'data' => $request,
        ]);
    }

    /**
     * Show the role creation form.
     */
    public function create()
    {
        $modules = Permission::orderBy('module')
            ->orderBy('name')
            ->get()
            ->groupBy('module');

        return view('roles.create', compact('modules'));
    }

    /**
     * Store a new role and its permissions.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                'unique:roles,name',
            ],
            'description' => [
                'nullable',
                'string',
                'max:150',
            ],
            'permissions' => [
                'nullable',
                'array',
            ],
            'permissions.*' => [
                'required',
                'integer',
                'distinct',
                'exists:permissions,id',
            ],
        ]);

        $role = Role::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
        ]);

        $role->permissions()->sync($data['permissions'] ?? []);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Show the role editing form.
     */
    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        $modules = Permission::orderBy('module')
            ->orderBy('name')
            ->get()
            ->groupBy('module');

        $selectedPermissions = $role->permissions
            ->pluck('id')
            ->toArray();

        return view('roles.edit', compact(
            'role',
            'modules',
            'selectedPermissions'
        ));
    }

    /**
     * Update role information and permissions.
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('roles', 'name')->ignore($role->id),
            ],
            'description' => [
                'nullable',
                'string',
                'max:150',
            ],
            'permissions' => [
                'nullable',
                'array',
            ],
            'permissions.*' => [
                'required',
                'integer',
                'distinct',
                'exists:permissions,id',
            ],
        ]);

        $role->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
        ]);

        $role->permissions()->sync($data['permissions'] ?? []);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Delete a role.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if ($role->users()->exists()) {
            return back()->with(
                'error',
                'This role cannot be deleted because it has assigned users.'
            );
        }

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
