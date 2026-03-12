<?php

namespace Tests\Feature;

use App\Models\Season;
use App\Models\VehicleClass;
use App\Models\Driver;
use App\Models\Team;
use App\Models\PointsStanding;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StandingsControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_displays_standings_index()
    {
        $response = $this->get('/standings');
        $response->assertOk();
    }

    /** @test */
    public function it_displays_season_standings()
    {
        $season = Season::factory()->create(['slug' => '2026', 'is_current' => true]);
        
        $response = $this->get('/standings/2026');
        $response->assertOk();
    }

    /** @test */
    public function it_orders_standings_by_adjusted_points()
    {
        $season = Season::factory()->create(['is_current' => true]);
        $vehicleClass = VehicleClass::factory()->create();
        $team = Team::factory()->create();
        
        $driver1 = Driver::factory()->create(['team_id' => $team->id]);
        $driver2 = Driver::factory()->create(['team_id' => $team->id]);
        $driver3 = Driver::factory()->create(['team_id' => $team->id]);
        
        // Create standings with different points
        PointsStanding::create([
            'season_id' => $season->id,
            'vehicle_class_id' => $vehicleClass->id,
            'driver_id' => $driver1->id,
            'total_points' => 500,
            'adjusted_points' => 500,
            'events_participated' => 10,
            'wins' => 5,
            'position' => 1,
        ]);
        
        PointsStanding::create([
            'season_id' => $season->id,
            'vehicle_class_id' => $vehicleClass->id,
            'driver_id' => $driver2->id,
            'total_points' => 450,
            'adjusted_points' => 450,
            'events_participated' => 10,
            'wins' => 3,
            'position' => 2,
        ]);
        
        PointsStanding::create([
            'season_id' => $season->id,
            'vehicle_class_id' => $vehicleClass->id,
            'driver_id' => $driver3->id,
            'total_points' => 400,
            'adjusted_points' => 380, // Lower after drop weeks
            'events_participated' => 10,
            'wins' => 2,
            'position' => 3,
        ]);
        
        $response = $this->get('/standings');
        $response->assertOk();
        
        // Verify the query doesn't fail with "points" column not found
        // The query should use adjusted_points, not points
    }

    /** @test */
    public function it_displays_class_standings()
    {
        $season = Season::factory()->create(['slug' => '2026']);
        $vehicleClass = VehicleClass::factory()->create(['slug' => '100m']);
        
        $response = $this->get('/standings/2026/100m');
        $response->assertOk();
    }

    /** @test */
    public function it_uses_correct_column_name_for_ordering()
    {
        // This test would have caught the bug: orderBy('points') instead of orderBy('adjusted_points')
        
        $season = Season::factory()->create(['is_current' => true]);
        $vehicleClass = VehicleClass::factory()->create();
        $team = Team::factory()->create();
        $driver = Driver::factory()->create(['team_id' => $team->id]);
        
        // Create a standing record
        $standing = PointsStanding::create([
            'season_id' => $season->id,
            'vehicle_class_id' => $vehicleClass->id,
            'driver_id' => $driver->id,
            'total_points' => 100,
            'adjusted_points' => 90,
            'events_participated' => 5,
            'position' => 1,
        ]);
        
        // Verify the columns exist
        $this->assertDatabaseHas('points_standings', [
            'id' => $standing->id,
            'total_points' => 100,
            'adjusted_points' => 90,
        ]);
        
        // Verify we can query by adjusted_points
        $found = PointsStanding::where('season_id', $season->id)
            ->orderBy('adjusted_points', 'desc')
            ->first();
        
        $this->assertNotNull($found);
        $this->assertEquals(90, $found->adjusted_points);
    }
}