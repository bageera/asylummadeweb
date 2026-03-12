<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Team;
use App\Models\Driver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDriverControllerTest extends TestCase
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
    public function guest_cannot_access_drivers_index()
    {
        $response = $this->get(route('admin.drivers.index'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function non_admin_cannot_access_drivers()
    {
        $user = User::factory()->create(['role' => 'driver']);
        $response = $this->actingAs($user)->get(route('admin.drivers.index'));
        $response->assertForbidden();
    }

    /** @test */
    public function admin_can_view_drivers_index()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.drivers.index'));
        $response->assertOk();
    }

    /** @test */
    public function admin_can_view_driver_details()
    {
        $team = Team::factory()->create();
        $driver = Driver::factory()->create(['team_id' => $team->id]);

        $response = $this->actingAs($this->admin)->get(route('admin.drivers.show', $driver));
        $response->assertOk();
    }

    /** @test */
    public function admin_can_create_driver()
    {
        $team = Team::factory()->create();

        $data = [
            'team_id' => $team->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'nickname' => 'Speedster',
            'hometown' => 'Atlanta, GA',
            'is_active' => true,
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.drivers.store'), $data);
        
        $response->assertRedirect(route('admin.drivers.index'));
        $this->assertDatabaseHas('drivers', ['first_name' => 'John', 'last_name' => 'Doe']);
    }

    /** @test */
    public function admin_can_update_driver()
    {
        $team = Team::factory()->create();
        $driver = Driver::factory()->create(['team_id' => $team->id]);

        $data = [
            'team_id' => $team->id,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'nickname' => 'Lightning',
            'hometown' => 'Miami, FL',
            'is_active' => true,
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.drivers.update', $driver), $data);
        
        $response->assertRedirect(route('admin.drivers.index'));
        $this->assertDatabaseHas('drivers', ['id' => $driver->id, 'first_name' => 'Jane']);
    }

    /** @test */
    public function admin_can_delete_driver()
    {
        $team = Team::factory()->create();
        $driver = Driver::factory()->create(['team_id' => $team->id]);

        $response = $this->actingAs($this->admin)->delete(route('admin.drivers.destroy', $driver));
        
        $response->assertRedirect(route('admin.drivers.index'));
        $this->assertDatabaseMissing('drivers', ['id' => $driver->id]);
    }

    /** @test */
    public function driver_validation_fails_without_required_fields()
    {
        $data = [
            'first_name' => 'John',
            // Missing last_name and team_id
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.drivers.store'), $data);
        $response->assertSessionHasErrors(['last_name', 'team_id']);
    }

    /** @test */
    public function driver_can_be_linked_to_user_account()
    {
        $team = Team::factory()->create();
        $user = User::factory()->create(['role' => 'driver']);

        $data = [
            'team_id' => $team->id,
            'user_id' => $user->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'is_active' => true,
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.drivers.store'), $data);
        
        $response->assertRedirect(route('admin.drivers.index'));
        $this->assertDatabaseHas('drivers', ['user_id' => $user->id]);
    }
}