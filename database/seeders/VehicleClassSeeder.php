<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleClass;

class VehicleClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            [
                'name' => 'Street Stock',
                'slug' => 'street-stock',
                'description' => 'Street-legal appearing stock cars with limited modifications.',
                'min_weight_lbs' => 3200,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Pure Stock',
                'slug' => 'pure-stock',
                'description' => 'Minimum modification stock class for entry-level competitors.',
                'min_weight_lbs' => 3400,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Super Stock',
                'slug' => 'super-stock',
                'description' => 'High-performance stock cars with enhanced engine modifications.',
                'min_weight_lbs' => 2800,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Modified',
                'slug' => 'modified',
                'description' => 'Open-wheel modified racing cars with significant modifications allowed.',
                'min_weight_lbs' => 2500,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Crate Late Model',
                'slug' => 'crate-late-model',
                'description' => 'Late model cars using sealed crate engines for cost control.',
                'min_weight_lbs' => 2300,
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Super Late Model',
                'slug' => 'super-late-model',
                'description' => 'Top-tier late model class with unlimited engine builds.',
                'min_weight_lbs' => 2300,
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Mini Stock',
                'slug' => 'mini-stock',
                'description' => 'Four-cylinder compact cars with limited modifications.',
                'min_weight_lbs' => 2300,
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Hornet',
                'slug' => 'hornet',
                'description' => 'Entry-level four-cylinder class for beginners.',
                'min_weight_lbs' => 2400,
                'sort_order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($classes as $class) {
            VehicleClass::updateOrCreate(
                ['slug' => $class['slug']],
                $class
            );
        }

        $this->command->info('Vehicle classes seeded: ' . count($classes));
    }
}