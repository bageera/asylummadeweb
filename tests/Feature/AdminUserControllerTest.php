<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $superUser;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->superUser = User::factory()->create(['role' => 'super_user']);
    }

    /** @test */
    public function guest_cannot_access_users_index()
    {
        $response = $this->get(route('admin.users.index'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function non_admin_cannot_access_users()
    {
        $user = User::factory()->create(['role' => 'driver']);
        $response = $this->actingAs($user)->get(route('admin.users.index'));
        $response->assertForbidden();
    }

    /** @test */
    public function admin_can_view_users_index()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.users.index'));
        $response->assertOk();
    }

    /** @test */
    public function admin_can_create_user()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'driver',
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.users.store'), $data);
        
        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    /** @test */
    public function admin_can_update_user()
    {
        $user = User::factory()->create();

        $data = [
            'name' => 'Updated Name',
            'email' => $user->email,
            'role' => 'team_owner',
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.users.update', $user), $data);
        
        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Updated Name']);
    }

    /** @test */
    public function admin_can_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('admin.users.destroy', $user));
        
        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** @test */
    public function user_validation_fails_with_duplicate_email()
    {
        $existingUser = User::factory()->create(['email' => 'existing@example.com']);

        $data = [
            'name' => 'New User',
            'email' => 'existing@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'driver',
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.users.store'), $data);
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function super_user_can_change_any_user_role()
    {
        $user = User::factory()->create(['role' => 'driver']);

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'role' => 'admin',
        ];

        $response = $this->actingAs($this->superUser)->put(route('admin.users.update', $user), $data);
        
        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', ['id' => $user->id, 'role' => 'admin']);
    }
}