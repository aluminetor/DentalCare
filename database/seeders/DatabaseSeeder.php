<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

/**
 * Initial seed data. Roles and permissions match the project permission matrix.
 * Safe to run multiple times without duplicating records (uses updateOrCreate).
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Base roles
        $roles = [
            'Administrator' => 'Manages users, roles, and the entire system',
            'Receptionist' => 'Registers patients and schedules appointments',
            'Dentist' => 'Views and updates their own appointments',
        ];
        foreach ($roles as $name => $description) {
            Role::updateOrCreate(['name' => $name], ['description' => $description]);
        }

        // 2. Permissions: [code, name, module]
        $permissions = [
            ['users.view', 'View users', 'Users'],
            ['users.create', 'Create user', 'Users'],
            ['users.edit', 'Edit user', 'Users'],
            ['users.delete', 'Delete user', 'Users'],
            ['roles.view', 'View roles', 'Roles and permissions'],
            ['roles.create', 'Create role', 'Roles and permissions'],
            ['roles.edit', 'Edit role', 'Roles and permissions'],
            ['roles.delete', 'Delete role', 'Roles and permissions'],
            ['roles.assign_permissions', 'Assign permissions to a role', 'Roles and permissions'],
            ['patients.view', 'View patients', 'Patients'],
            ['patients.create', 'Register patient', 'Patients'],
            ['patients.edit', 'Edit patient', 'Patients'],
            ['patients.delete', 'Delete patient', 'Patients'],
            ['appointments.view', 'View appointments', 'Appointments'],
            ['appointments.create', 'Create appointment', 'Appointments'],
            ['appointments.edit', 'Edit appointment', 'Appointments'],
            ['appointments.delete', 'Delete appointment', 'Appointments'],
        ];
        foreach ($permissions as [$code, $name, $module]) {
            Permission::updateOrCreate(['code' => $code], ['name' => $name, 'module' => $module]);
        }

        // 3. Permissions per role
        $permissionsByRole = [
            'Administrator' => Permission::pluck('code')->all(),   // all permissions
            'Receptionist' => [
                'patients.view',
                'patients.create',
                'patients.edit',
                'appointments.view',
                'appointments.create',
                'appointments.edit',
                'appointments.delete',
            ],
            'Dentist' => [
                'patients.view',
                'appointments.view',
                'appointments.edit',
            ],
        ];
        foreach ($permissionsByRole as $roleName => $codes) {
            $ids = Permission::whereIn('code', $codes)->pluck('id');
            Role::where('name', $roleName)->first()->permissions()->sync($ids);
        }

        // 4. One sample user per role for testing (password: password)
        $this->call(UserSeeder::class);

        // 5. Sample patients
        $patients = [
            ['Mary', 'Lopez', '1012345678', '3001234567', '1990-05-14'],
            ['John', 'Perez', '1098765432', '3109876543', '1985-11-02'],
            ['Laura', 'Gomez', '1001122334', '3205566778', '2001-03-27'],
        ];
        foreach ($patients as [$firstName, $lastName, $document, $phone, $birthDate]) {
            Patient::updateOrCreate(['document' => $document], [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'phone' => $phone,
                'birth_date' => $birthDate,
            ]);
        }
    }
}
