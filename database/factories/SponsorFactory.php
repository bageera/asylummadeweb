<?php

namespace Database\Factories;

use App\Models\Sponsor;
use Illuminate\Database\Eloquent\Factories\Factory;

class SponsorFactory extends Factory
{
    protected $model = Sponsor::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph(),
            'website' => $this->faker->url(),
            'logo_path' => null,
            'tier' => $this->faker->numberBetween(1, 4),
            'is_active' => true,
            'sort_order' => 0,
        ];
    }

    public function platinum(): static
    {
        return $this->state(['tier' => Sponsor::TIER_PLATINUM]);
    }

    public function gold(): static
    {
        return $this->state(['tier' => Sponsor::TIER_GOLD]);
    }

    public function silver(): static
    {
        return $this->state(['tier' => Sponsor::TIER_SILVER]);
    }

    public function bronze(): static
    {
        return $this->state(['tier' => Sponsor::TIER_BRONZE]);
    }

    public function inactive(): static
    {
        return $this->state(['is_active' => false]);
    }
}