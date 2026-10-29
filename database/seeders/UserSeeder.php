<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuarios de prueba por cada rol (contraseña: password)
        $usuarios = [
            ['Ana', 'Admin', 'admin@dentalcare.test', 'Administrador', null],
            ['Rosa', 'Recepción', 'recepcion@dentalcare.test', 'Recepcionista', null],
            ['Carlos', 'Mejía', 'odontologo@dentalcare.test', 'Odontólogo', 'Odontología general'],
        ];

        foreach ($usuarios as [$name, $apellido, $email, $rol, $especialidad]) {
            User::updateOrCreate(['email' => $email], [
                'name' => $name,
                'apellido' => $apellido,
                'password' => Hash::make('password'),
                'especialidad' => $especialidad,
                'rol_id' => Rol::where('nombre', $rol)->value('id'),
            ]);
        }
    }
}
