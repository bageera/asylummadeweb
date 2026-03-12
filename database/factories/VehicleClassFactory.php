<?php

namespace Database\Factories;

use App\Models\VehicleClass;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleClassFactory extends Factory
{
    protected $model = VehicleClass::class;

    public function definition(): array
    {
        $name = $this->faker->randomElement(['100m', '200m', '400m', '800m', '1500m', '5000m', '10000m', '110m Hurdles', '400m Hurdles', 'Long Jump', 'High Jump', 'Triple Jump', 'Pole Vault', 'Shot Put', 'Discus', 'Javelin', 'Hammer Throw']);
        
        return [
            'name' => $name,
            'slug' => \Str::slug($name),
            'description' => $this->faker->sentence(),
            'is_active' => true,
            'sort_order' => $this->faker->numberBetween(1, 20),
        ];
    }

    public function inactive(): static
    {
        return $this->state(['is_active' => false]);
    }
}