<?php

namespace Database\Factories;

use App\Models\WaiverTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class WaiverTemplateFactory extends Factory
{
    protected $model = WaiverTemplate::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true) . ' Waiver',
            'slug' => $this->faker->slug(),
            'content' => $this->faker->paragraphs(3, true),
            'version' => '1.0',
            'requires_signature' => true,
            'requires_parent_signature' => false,
            'valid_for_days' => 365,
            'is_active' => true,
        ];
    }

    public function forMinors(): static
    {
        return $this->state([
            'requires_parent_signature' => true,
        ]);
    }

    public function annual(): static
    {
        return $this->state(['valid_for_days' => 365]);
    }

    public function eventOnly(): static
    {
        return $this->state(['valid_for_days' => 0]); // No expiry
    }

    public function inactive(): static
    {
        return $this->state(['is_active' => false]);
    }
}