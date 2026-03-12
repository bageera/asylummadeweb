<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Season;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminEventControllerTest extends TestCase
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
    public function guest_cannot_access_events_index()
    {
        $response = $this->get(route('admin.events.index'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function non_admin_cannot_access_events()
    {
        $user = User::factory()->create(['role' => 'driver']);
        $response = $this->actingAs($user)->get(route('admin.events.index'));
        $response->assertForbidden();
    }

    /** @test */
    public function admin_can_view_events_index()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.events.index'));
        $response->assertOk();
    }

    /** @test */
    public function admin_can_create_event()
    {
        $season = Season::factory()->create();

        $data = [
            'season_id' => $season->id,
            'name' => 'Spring Championship',
            'slug' => 'spring-championship',
            'event_date' => now()->addMonths(2)->format('Y-m-d'),
            'status' => 'scheduled',
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.events.store'), $data);
        
        $response->assertRedirect(route('admin.events.index'));
        $this->assertDatabaseHas('events', ['name' => 'Spring Championship']);
    }

    /** @test */
    public function admin_can_update_event()
    {
        $event = Event::factory()->create();

        $data = [
            'season_id' => $event->season_id,
            'name' => 'Updated Event Name',
            'slug' => 'updated-event-name',
            'event_date' => $event->event_date->format('Y-m-d'),
            'status' => 'registration_open',
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.events.update', $event), $data);
        
        $response->assertRedirect(route('admin.events.index'));
        $this->assertDatabaseHas('events', ['id' => $event->id, 'name' => 'Updated Event Name']);
    }

    /** @test */
    public function admin_can_delete_event()
    {
        $event = Event::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('admin.events.destroy', $event));
        
        $response->assertRedirect(route('admin.events.index'));
        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }

    /** @test */
    public function event_validation_fails_without_name()
    {
        $season = Season::factory()->create();

        $data = [
            'season_id' => $season->id,
            'event_date' => now()->format('Y-m-d'),
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.events.store'), $data);
        $response->assertSessionHasErrors('name');
    }
}