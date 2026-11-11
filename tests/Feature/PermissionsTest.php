<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    private function asUser(string $email)
    {
        return $this->actingAs(User::where('email', $email)->firstOrFail());
    }

    public function test_admin_can_view_users(): void
    {
        $this->asUser('admin@dentalcare.test')->get('/users')->assertOk();
    }

    public function test_receptionist_cannot_view_users(): void
    {
        $this->asUser('reception@dentalcare.test')->get('/users')->assertForbidden();
    }

    public function test_dentist_cannot_create_patients_or_users(): void
    {
        $this->asUser('dentist@dentalcare.test')->get('/patients/create')->assertForbidden();
        $this->get('/users/create')->assertForbidden();
    }

    public function test_nonexistent_user_without_permission_returns_403(): void
    {
        $this->asUser('reception@dentalcare.test')->get('/users/9999/edit')->assertForbidden();
    }

    public function test_create_user_without_last_name_shows_validation_error(): void
    {
        $this->asUser('admin@dentalcare.test')->post('/users/store', [
            'name' => 'Ana', 'email' => 'ana@test.com', 'role_id' => 2,
            'password' => 'password123', 'password_confirmation' => 'password123',
        ])->assertSessionHasErrors('last_name');
    }

    public function test_logout_blocks_protected_routes(): void
    {
        $this->asUser('admin@dentalcare.test')->post('/logout');
        $this->get('/users')->assertRedirect('/login');
    }

    public function test_403_page_is_in_english(): void
    {
        $this->asUser('reception@dentalcare.test')->get('/users')
            ->assertForbidden()->assertSee('Access Denied');
    }
}
