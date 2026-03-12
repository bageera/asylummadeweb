<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition(): array
    {
        $name = $this->faker->company() . ' Racing';
        
        return [
            'name' => $name,
            'slug' => \Str::slug($name),
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
            'established_year' => $this->faker->year(),
            'primary_contact_email' => $this->faker->email(),
            'primary_contact_phone' => $this->faker->phoneNumber(),
            'bio' => $this->faker->paragraph(),
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(['is_active' => false]);
    }
}