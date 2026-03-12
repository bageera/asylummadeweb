<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\WaiverTemplate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminWaiverControllerTest extends TestCase
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
    public function guest_cannot_access_waivers_index()
    {
        $response = $this->get(route('admin.waivers.index'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function non_admin_cannot_access_waivers()
    {
        $user = User::factory()->create(['role' => 'driver']);
        $response = $this->actingAs($user)->get(route('admin.waivers.index'));
        $response->assertForbidden();
    }

    /** @test */
    public function admin_can_view_waivers_index()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.waivers.index'));
        $response->assertOk();
    }

    /** @test */
    public function admin_can_create_waiver_template()
    {
        $data = [
            'name' => 'Liability Waiver 2026',
            'content' => 'I hereby release {{organization}} from all liability...',
            'version' => '1.0',
            'validity_days' => 365,
            'is_active' => true,
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.waivers.store'), $data);
        
        $response->assertRedirect(route('admin.waivers.index'));
        $this->assertDatabaseHas('waiver_templates', ['name' => 'Liability Waiver 2026']);
    }

    /** @test */
    public function admin_can_update_waiver_template()
    {
        $waiver = WaiverTemplate::factory()->create();

        $data = [
            'name' => 'Updated Waiver Name',
            'content' => $waiver->content,
            'version' => $waiver->version,
            'validity_days' => 365,
            'is_active' => true,
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.waivers.update', $waiver), $data);
        
        $response->assertRedirect(route('admin.waivers.index'));
        $this->assertDatabaseHas('waiver_templates', ['id' => $waiver->id, 'name' => 'Updated Waiver Name']);
    }

    /** @test */
    public function admin_can_delete_waiver_template()
    {
        $waiver = WaiverTemplate::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('admin.waivers.destroy', $waiver));
        
        $response->assertRedirect(route('admin.waivers.index'));
        $this->assertDatabaseMissing('waiver_templates', ['id' => $waiver->id]);
    }

    /** @test */
    public function admin_can_view_signed_waivers()
    {
        $waiver = WaiverTemplate::factory()->create();

        $response = $this->actingAs($this->admin)->get(route('admin.waivers.signed', $waiver));
        $response->assertOk();
    }

    /** @test */
    public function waiver_validation_fails_without_name()
    {
        $data = [
            'content' => 'Test content',
            'version' => '1.0',
            'validity_days' => 365,
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.waivers.store'), $data);
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function waiver_validation_fails_without_content()
    {
        $data = [
            'name' => 'Test Waiver',
            'version' => '1.0',
            'validity_days' => 365,
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.waivers.store'), $data);
        $response->assertSessionHasErrors('content');
    }
}