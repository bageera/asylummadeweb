<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTeamControllerTest extends TestCase
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
    public function guest_cannot_access_teams_index()
    {
        $response = $this->get(route('admin.teams.index'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function non_admin_cannot_access_teams()
    {
        $user = User::factory()->create(['role' => 'driver']);
        $response = $this->actingAs($user)->get(route('admin.teams.index'));
        $response->assertForbidden();
    }

    /** @test */
    public function admin_can_view_teams_index()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.teams.index'));
        $response->assertOk();
    }

    /** @test */
    public function admin_can_view_team_details()
    {
        $team = Team::factory()->create();

        $response = $this->actingAs($this->admin)->get(route('admin.teams.show', $team));
        $response->assertOk();
    }

    /** @test */
    public function admin_can_create_team()
    {
        $data = [
            'name' => 'Velocity Racing',
            'slug' => 'velocity-racing',
            'city' => 'Atlanta',
            'state' => 'GA',
            'is_active' => true,
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.teams.store'), $data);
        
        $response->assertRedirect(route('admin.teams.index'));
        $this->assertDatabaseHas('teams', ['name' => 'Velocity Racing']);
    }

    /** @test */
    public function admin_can_update_team()
    {
        $team = Team::factory()->create();

        $data = [
            'name' => 'Updated Team Name',
            'slug' => 'updated-team-name',
            'city' => 'New York',
            'state' => 'NY',
            'is_active' => true,
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.teams.update', $team), $data);
        
        $response->assertRedirect(route('admin.teams.index'));
        $this->assertDatabaseHas('teams', ['id' => $team->id, 'name' => 'Updated Team Name']);
    }

    /** @test */
    public function admin_can_delete_team()
    {
        $team = Team::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('admin.teams.destroy', $team));
        
        $response->assertRedirect(route('admin.teams.index'));
        $this->assertDatabaseMissing('teams', ['id' => $team->id]);
    }

    /** @test */
    public function team_validation_fails_without_name()
    {
        $data = [
            'slug' => 'test-team',
            'city' => 'Atlanta',
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.teams.store'), $data);
        $response->assertSessionHasErrors('name');
    }
}