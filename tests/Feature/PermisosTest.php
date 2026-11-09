<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermisosTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    private function como(string $email)
    {
        return $this->actingAs(User::where('email', $email)->firstOrFail());
    }

    public function test_admin_ve_usuarios(): void
    {
        $this->como('admin@dentalcare.test')->get('/usuarios')->assertOk();
    }

    public function test_recepcionista_no_ve_usuarios(): void
    {
        $this->como('recepcion@dentalcare.test')->get('/usuarios')->assertForbidden();
    }

    public function test_odontologo_no_crea_pacientes_ni_usuarios(): void
    {
        $this->como('odontologo@dentalcare.test')->get('/pacientes/create')->assertForbidden();
        $this->get('/usuarios/create')->assertForbidden();
    }

    public function test_usuario_inexistente_sin_permiso_da_403(): void
    {
        $this->como('recepcion@dentalcare.test')->get('/usuarios/9999/edit')->assertForbidden();
    }

    public function test_crear_usuario_sin_apellido_muestra_error_y_no_falla(): void
    {
        $this->como('admin@dentalcare.test')->post('/usuarios/store', [
            'name' => 'Ana', 'email' => 'ana@test.com', 'rol_id' => 2,
            'password' => 'password123', 'password_confirmation' => 'password123',
        ])->assertSessionHasErrors("apellido");
    }

    public function test_cerrar_sesion_bloquea_rutas_protegidas(): void
    {
        $this->como('admin@dentalcare.test')->post('/logout');
        $this->get('/usuarios')->assertRedirect('/login');
    }

    public function test_pagina_403_esta_en_espanol(): void
    {
        $this->como('recepcion@dentalcare.test')->get('/usuarios')
            ->assertForbidden()->assertSee('Acceso denegado');
    }
}
