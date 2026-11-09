<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    // Shared validation rules for create and edit. Max lengths match the users table columns.
    private function baseRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:60'],
            'last_name' => ['required', 'string', 'max:60'],
            'phone' => ['nullable', 'string', 'max:20'],
            'specialty' => ['nullable', 'string', 'max:80'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
        ];
    }

    private function messages(): array
    {
        return [
            'name.required' => 'The first name is required.',
            'name.max' => 'The first name may not be greater than :max characters.',
            'last_name.required' => 'The last name is required.',
            'last_name.max' => 'The last name may not be greater than :max characters.',
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be a valid format.',
            'email.max' => 'The email address may not be greater than :max characters.',
            'email.unique' => 'A user with this email address already exists.',
            'phone.max' => 'The phone number may not be greater than :max characters.',
            'specialty.max' => 'The specialty may not be greater than :max characters.',
            'role_id.required' => 'You must select a role.',
            'role_id.exists' => 'The selected role does not exist.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least :min characters.',
            'password.confirmed' => 'The password confirmation does not match.',
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

        $users = User::with('role')
            ->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', "%$request->filter%")
                      ->orWhere('last_name', 'LIKE', "%$request->filter%")
                      ->orWhere('email', 'LIKE', "%$request->filter%")
                      ->orWhere('specialty', 'LIKE', "%$request->filter%")
                      ->orWhereHas('role', function ($q) use ($request) {
                          $q->where('name', 'LIKE', "%$request->filter%");
                      });
            })
            ->orderBy('name', 'asc')
            ->paginate($request->records_per_page);

        return view('users.index', [
            'users' => $users,
            'data' => $request,
        ]);
    }

    public function create()
    {
        $roles = Role::orderBy('name', 'asc')->get();

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->baseRules() + [
            'email' => ['required', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $this->messages());

        User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'specialty' => $data['specialty'] ?? null,
            'role_id' => $data['role_id'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    // Lookup by id inside the method (instead of route-model binding) so that permission
    // is checked BEFORE: without permission it always returns 403, whether the user exists or not.
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name', 'asc')->get();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate($this->baseRules() + [
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], $this->messages());

        $user->name = $data['name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'] ?? null;
        $user->specialty = $data['specialty'] ?? null;
        $user->role_id = $data['role_id'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with(
                'error',
                'You cannot delete your own account while logged in.'
            );
        }

        if ($user->appointments()->exists()) {
            return back()->with(
                'error',
                'You cannot delete a user who has assigned appointments.'
            );
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
