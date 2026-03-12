<?php

namespace Database\Factories;

use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeasonFactory extends Factory
{
    protected $model = Season::class;

    public function definition(): array
    {
        $year = $this->faker->year();
        
        return [
            'year' => $year,
            'slug' => $year,
            'name' => $year . ' Season',
            'is_current' => false,
            'starts_at' => now()->startOfYear(),
            'ends_at' => now()->endOfYear(),
        ];
    }

    public function current(): static
    {
        return $this->state(['is_current' => true]);
    }
}