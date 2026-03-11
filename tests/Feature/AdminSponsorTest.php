<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Sponsor;
use App\Models\WaiverTemplate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSponsorTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function guest_cannot_access_sponsors_index()
    {
        $response = $this->get(route('admin.sponsors.index'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function non_admin_cannot_access_sponsors_index()
    {
        $user = User::factory()->create(['role' => 'driver']);
        $response = $this->actingAs($user)->get(route('admin.sponsors.index'));
        $response->assertForbidden();
    }

    /** @test */
    public function admin_can_access_sponsors_index()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->get(route('admin.sponsors.index'));
        $response->assertOk();
    }

    /** @test */
    public function super_user_can_access_sponsors_index()
    {
        $user = User::factory()->create(['role' => 'super_user']);
        $response = $this->actingAs($user)->get(route('admin.sponsors.index'));
        $response->assertOk();
    }

    /** @test */
    public function admin_can_create_sponsor()
    {
        $user = User::factory()->create(['role' => 'admin']);
        
        $response = $this->actingAs($user)->post(route('admin.sponsors.store'), [
            'name' => 'Test Sponsor',
            'tier' => 3,
            'is_active' => true,
        ]);

        $response->assertRedirect(route('admin.sponsors.index'));
        $this->assertDatabaseHas('sponsors', [
            'name' => 'Test Sponsor',
            'tier' => 3,
        ]);
    }

    /** @test */
    public function admin_can_update_sponsor()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $sponsor = Sponsor::factory()->create(['name' => 'Old Name', 'tier' => 1]);
        
        $response = $this->actingAs($user)->put(route('admin.sponsors.update', $sponsor), [
            'name' => 'New Name',
            'tier' => 4,
            'is_active' => true,
        ]);

        $response->assertRedirect(route('admin.sponsors.index'));
        $this->assertDatabaseHas('sponsors', [
            'id' => $sponsor->id,
            'name' => 'New Name',
            'tier' => 4,
        ]);
    }

    /** @test */
    public function admin_can_delete_sponsor()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $sponsor = Sponsor::factory()->create();
        
        $response = $this->actingAs($user)->delete(route('admin.sponsors.destroy', $sponsor));

        $response->assertRedirect(route('admin.sponsors.index'));
        $this->assertDatabaseMissing('sponsors', ['id' => $sponsor->id]);
    }
}