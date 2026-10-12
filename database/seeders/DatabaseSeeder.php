<?php

namespace Database\Seeders;

use App\Models\Paciente;
use App\Models\Permiso;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Datos iniciales. Los roles y permisos salen de la matriz de permisos (documento del proyecto).
 * Se puede correr varias veces sin duplicar (usa updateOrCreate).
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles base
        $roles = [
            'Administrador' => 'Gestiona usuarios, roles y todo el sistema',
            'Recepcionista' => 'Registra pacientes y agenda citas',
            'Odontólogo' => 'Consulta y actualiza sus propias citas',
        ];
        foreach ($roles as $nombre => $descripcion) {
            Rol::updateOrCreate(['nombre' => $nombre], ['descripcion' => $descripcion]);
        }

        // 2. Permisos: [codigo, nombre, modulo]
        $permisos = [
            ['usuarios.ver', 'Ver usuarios', 'Usuarios'],
            ['usuarios.crear', 'Crear usuario', 'Usuarios'],
            ['usuarios.editar', 'Editar usuario', 'Usuarios'],
            ['usuarios.eliminar', 'Eliminar usuario', 'Usuarios'],
            ['roles.ver', 'Ver roles', 'Roles y permisos'],
            ['roles.crear', 'Crear rol', 'Roles y permisos'],
            ['roles.editar', 'Editar rol', 'Roles y permisos'],
            ['roles.eliminar', 'Eliminar rol', 'Roles y permisos'],
            ['roles.asignar_permisos', 'Asignar permisos a un rol', 'Roles y permisos'],
            ['pacientes.ver', 'Ver pacientes', 'Pacientes'],
            ['pacientes.registrar', 'Registrar paciente', 'Pacientes'],
            ['pacientes.editar', 'Editar paciente', 'Pacientes'],
            ['pacientes.eliminar', 'Eliminar paciente', 'Pacientes'],
            ['citas.ver', 'Ver citas', 'Citas'],
            ['citas.crear', 'Crear cita', 'Citas'],
            ['citas.editar', 'Editar cita', 'Citas'],
            ['citas.eliminar', 'Eliminar cita', 'Citas'],
        ];
        foreach ($permisos as [$codigo, $nombre, $modulo]) {
            Permiso::updateOrCreate(['codigo' => $codigo], ['nombre' => $nombre, 'modulo' => $modulo]);
        }

        // 3. Permisos de cada rol (los de la matriz)
        $permisosPorRol = [
            'Administrador' => Permiso::pluck('codigo')->all(),   // todos
            'Recepcionista' => [
                'pacientes.ver',
                'pacientes.registrar',
                'pacientes.editar',
                'citas.ver',
                'citas.crear',
                'citas.editar',
                'citas.eliminar',
            ],
            'Odontólogo' => [
                'pacientes.ver',
                'citas.ver',
                'citas.editar',
            ],
        ];
        foreach ($permisosPorRol as $nombreRol => $codigos) {
            $ids = Permiso::whereIn('codigo', $codigos)->pluck('id');
            Rol::where('nombre', $nombreRol)->first()->permisos()->sync($ids);
        }

        // 4. Un usuario de cada rol para poder probar (contraseña: password)
        $usuarios = [
            ['Ana', 'Admin', 'admin@dentalcare.test', 'Administrador', null],
            ['Rosa', 'Recepción', 'recepcion@dentalcare.test', 'Recepcionista', null],
            ['Carlos', 'Mejía', 'odontologo@dentalcare.test', 'Odontólogo', 'Odontología general'],
        ];
        foreach ($usuarios as [$name, $apellido, $email, $rol, $especialidad]) {
            User::updateOrCreate(['email' => $email], [
                'name' => $name,
                'apellido' => $apellido,
                'password' => 'password',   // el modelo User la guarda cifrada (hash)
                'especialidad' => $especialidad,
                'rol_id' => Rol::where('nombre', $rol)->value('id'),
            ]);
        }

        // 5. Pacientes de ejemplo
        $pacientes = [
            ['María', 'López', '1012345678', '3001234567', '1990-05-14'],
            ['Juan', 'Pérez', '1098765432', '3109876543', '1985-11-02'],
            ['Laura', 'Gómez', '1001122334', '3205566778', '2001-03-27'],
        ];
        foreach ($pacientes as [$nombre, $apellido, $documento, $telefono, $nacimiento]) {
            Paciente::updateOrCreate(['documento' => $documento], [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'telefono' => $telefono,
                'fecha_nacimiento' => $nacimiento,
            ]);
        }
    }
}
