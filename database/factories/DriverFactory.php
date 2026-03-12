<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    protected $model = Driver::class;

    public function definition(): array
    {
        return [
            'team_id' => Team::factory(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'nickname' => $this->faker->optional(0.3)->firstName(),
            'hometown' => $this->faker->city() . ', ' . $this->faker->stateAbbr(),
            'license_number' => strtoupper($this->faker->bothify('???-####')),
            'license_expires' => $this->faker->dateTimeBetween('now', '+2 years'),
            'medical_expires' => $this->faker->dateTimeBetween('now', '+1 year'),
            'bio' => $this->faker->optional()->paragraph(),
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(['is_active' => false]);
    }

    public function forTeam(Team $team): static
    {
        return $this->state(['team_id' => $team->id]);
    }
}