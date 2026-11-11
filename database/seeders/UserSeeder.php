<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Sample users for each role (password: password)
        $users = [
            ['Ana', 'Admin', 'admin@dentalcare.test', 'Administrator', null],
            ['Rose', 'Reception', 'reception@dentalcare.test', 'Receptionist', null],
            ['Charles', 'Miller', 'dentist@dentalcare.test', 'Dentist', 'General Dentistry'],
        ];

        foreach ($users as [$name, $lastName, $email, $role, $specialty]) {
            User::updateOrCreate(['email' => $email], [
                'name' => $name,
                'last_name' => $lastName,
                'password' => Hash::make('password'),
                'specialty' => $specialty,
                'role_id' => Role::where('name', $role)->value('id'),
            ]);
        }
    }
}
