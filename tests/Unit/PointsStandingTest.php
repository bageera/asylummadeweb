<?php

namespace Tests\Unit;

use App\Models\PointsStanding;
use App\Models\Season;
use App\Models\VehicleClass;
use App\Models\Driver;
use Tests\TestCase;

class PointsStandingTest extends TestCase
{
    /** @test */
    public function it_has_correct_fillable_attributes()
    {
        $standing = new PointsStanding();
        
        $fillable = [
            'season_id',
            'vehicle_class_id',
            'driver_id',
            'events_participated',
            'events_counted',
            'wins',
            'top5',
            'top10',
            'poles',
            'laps_led',
            'total_points',
            'adjusted_points',
            'position',
            'previous_position',
        ];
        
        $this->assertEquals($fillable, $standing->getFillable());
    }

    /** @test */
    public function it_casts_integers_correctly()
    {
        $standing = new PointsStanding([
            'events_participated' => '5',
            'total_points' => '150',
            'adjusted_points' => '140',
            'position' => '1',
        ]);
        
        $this->assertIsInt($standing->events_participated);
        $this->assertIsInt($standing->total_points);
        $this->assertIsInt($standing->adjusted_points);
        $this->assertIsInt($standing->position);
    }

    /** @test */
    public function it_belongs_to_season()
    {
        $standing = new PointsStanding();
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\BelongsTo::class,
            $standing->season()
        );
    }

    /** @test */
    public function it_belongs_to_vehicle_class()
    {
        $standing = new PointsStanding();
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\BelongsTo::class,
            $standing->vehicleClass()
        );
    }

    /** @test */
    public function it_belongs_to_driver()
    {
        $standing = new PointsStanding();
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Relations\BelongsTo::class,
            $standing->driver()
        );
    }

    /** @test */
    public function it_calculates_position_change()
    {
        $standing = new PointsStanding([
            'position' => 3,
            'previous_position' => 5,
        ]);
        
        // Position improved from 5 to 3 = +2 change
        $this->assertEquals(2, $standing->position_change);
    }

    /** @test */
    public function it_calculates_negative_position_change()
    {
        $standing = new PointsStanding([
            'position' => 5,
            'previous_position' => 3,
        ]);
        
        // Position dropped from 3 to 5 = -2 change
        $this->assertEquals(-2, $standing->position_change);
    }

    /** @test */
    public function it_handles_no_previous_position()
    {
        $standing = new PointsStanding([
            'position' => 1,
            'previous_position' => null,
        ]);
        
        $this->assertEquals(0, $standing->position_change);
    }

    /** @test */
    public function it_formats_movement_text_up()
    {
        $standing = new PointsStanding([
            'position' => 3,
            'previous_position' => 5,
        ]);
        
        $this->assertEquals('↑2', $standing->movement_text);
    }

    /** @test */
    public function it_formats_movement_text_down()
    {
        $standing = new PointsStanding([
            'position' => 5,
            'previous_position' => 3,
        ]);
        
        $this->assertEquals('↓2', $standing->movement_text);
    }

    /** @test */
    public function it_formats_movement_text_no_change()
    {
        $standing = new PointsStanding([
            'position' => 3,
            'previous_position' => 3,
        ]);
        
        $this->assertEquals('—', $standing->movement_text);
    }

    /** @test */
    public function it_uses_adjusted_points_for_ordering()
    {
        // This test verifies the column name is correct
        $standing = new PointsStanding([
            'total_points' => 500,
            'adjusted_points' => 450,
        ]);
        
        $this->assertEquals(500, $standing->total_points);
        $this->assertEquals(450, $standing->adjusted_points);
        
        // Adjusted points should be used for standings (after drop weeks)
        $this->assertLessThan($standing->total_points, $standing->adjusted_points);
    }
}