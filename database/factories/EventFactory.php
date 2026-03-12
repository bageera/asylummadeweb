<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $name = $this->faker->randomElement(['Spring Championship', 'Summer Sprint', 'Fall Classic', 'Winter Invitational', 'Season Opener', 'Season Finale']);
        
        return [
            'season_id' => Season::factory(),
            'name' => $name,
            'slug' => \Str::slug($name . '-' . $this->faker->year()),
            'event_date' => $this->faker->dateTimeBetween('now', '+6 months'),
            'gates_open_time' => '09:00:00',
            'practice_start_time' => '10:00:00',
            'racing_start_time' => '12:00:00',
            'admission_general' => $this->faker->randomFloat(2, 10, 50),
            'admission_pit_pass' => $this->faker->randomFloat(2, 15, 75),
            'status' => 'scheduled',
            'is_published' => true,
        ];
    }

    public function published(): static
    {
        return $this->state(['is_published' => true]);
    }

    public function draft(): static
    {
        return $this->state(['is_published' => false]);
    }

    public function registrationOpen(): static
    {
        return $this->state(['status' => 'registration_open']);
    }

    public function completed(): static
    {
        return $this->state(['status' => 'completed']);
    }
}