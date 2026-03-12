<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Season;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSeasonControllerTest extends TestCase
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
    public function guest_cannot_access_seasons_index()
    {
        $response = $this->get(route('admin.seasons.index'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function non_admin_cannot_access_seasons()
    {
        $user = User::factory()->create(['role' => 'driver']);
        $response = $this->actingAs($user)->get(route('admin.seasons.index'));
        $response->assertForbidden();
    }

    /** @test */
    public function admin_can_view_seasons_index()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.seasons.index'));
        $response->assertOk();
    }

    /** @test */
    public function super_user_can_view_seasons_index()
    {
        $response = $this->actingAs($this->superUser)->get(route('admin.seasons.index'));
        $response->assertOk();
    }

    /** @test */
    public function admin_can_create_season()
    {
        $data = [
            'year' => 2026,
            'name' => '2026 Racing Season',
            'is_current' => true,
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.seasons.store'), $data);
        
        $response->assertRedirect(route('admin.seasons.index'));
        $this->assertDatabaseHas('seasons', $data);
    }

    /** @test */
    public function admin_can_update_season()
    {
        $season = Season::factory()->create();

        $data = [
            'year' => 2027,
            'name' => '2027 Racing Season',
            'is_current' => false,
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.seasons.update', $season), $data);
        
        $response->assertRedirect(route('admin.seasons.index'));
        $this->assertDatabaseHas('seasons', ['id' => $season->id, 'name' => '2027 Racing Season']);
    }

    /** @test */
    public function admin_cannot_delete_season()
    {
        $season = Season::factory()->create();

        // Season deletion is disabled in routes (except => ['show', 'destroy'])
        // Actually, destroy is excepted, but let's check the route definition
        $response = $this->actingAs($this->admin)->delete(route('admin.seasons.destroy', $season));
        $response->assertNotFound(); // Route doesn't exist
    }

    /** @test */
    public function season_validation_fails_with_invalid_year()
    {
        $data = [
            'year' => 'invalid',
            'name' => 'Test Season',
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.seasons.store'), $data);
        $response->assertSessionHasErrors('year');
    }
}