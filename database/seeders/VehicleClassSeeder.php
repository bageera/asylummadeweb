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
            // Track Events - Sprints
            [
                'name' => '100m Sprint',
                'slug' => '100m-sprint',
                'description' => 'Pure sprint event — fastest athlete wins.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => '200m Sprint',
                'slug' => '200m-sprint',
                'description' => 'Half-lap sprint combining speed and curve running.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => '400m Sprint',
                'slug' => '400m-sprint',
                'description' => 'One full lap — speed endurance event.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            
            // Track Events - Distance
            [
                'name' => '800m Run',
                'slug' => '800m-run',
                'description' => 'Two laps — middle distance event.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => '1600m Run',
                'slug' => '1600m-run',
                'description' => 'One mile — distance endurance event.',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => '3200m Run',
                'slug' => '3200m-run',
                'description' => 'Two miles — long distance event.',
                'sort_order' => 6,
                'is_active' => true,
            ],
            
            // Track Events - Hurdles
            [
                'name' => '100m Hurdles',
                'slug' => '100m-hurdles',
                'description' => 'Women\'s hurdle event — technique + speed.',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => '110m Hurdles',
                'slug' => '110m-hurdles',
                'description' => 'Men\'s hurdle event — technique + speed.',
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'name' => '300m Hurdles',
                'slug' => '300m-hurdles',
                'description' => 'Intermediate hurdles — 3/4 lap.',
                'sort_order' => 9,
                'is_active' => true,
            ],
            
            // Field Events - Jumps
            [
                'name' => 'Long Jump',
                'slug' => 'long-jump',
                'description' => 'Running long jump — distance measured from board.',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Triple Jump',
                'slug' => 'triple-jump',
                'description' => 'Hop, step, jump — combination event.',
                'sort_order' => 11,
                'is_active' => true,
            ],
            [
                'name' => 'High Jump',
                'slug' => 'high-jump',
                'description' => 'Fosbury flop technique — bar height.',
                'sort_order' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'Pole Vault',
                'slug' => 'pole-vault',
                'description' => 'Bar clearance with pole — height event.',
                'sort_order' => 13,
                'is_active' => true,
            ],
            
            // Field Events - Throws
            [
                'name' => 'Shot Put',
                'slug' => 'shot-put',
                'description' => 'Heavy ball thrown from circle — distance.',
                'sort_order' => 14,
                'is_active' => true,
            ],
            [
                'name' => 'Discus',
                'slug' => 'discus',
                'description' => 'Disc thrown from circle — distance.',
                'sort_order' => 15,
                'is_active' => true,
            ],
            [
                'name' => 'Javelin',
                'slug' => 'javelin',
                'description' => 'Spear thrown from runway — distance.',
                'sort_order' => 16,
                'is_active' => true,
            ],
            
            // Relays
            [
                'name' => '4x100m Relay',
                'slug' => '4x100m-relay',
                'description' => 'Four athletes, one lap total with baton.',
                'sort_order' => 17,
                'is_active' => true,
            ],
            [
                'name' => '4x400m Relay',
                'slug' => '4x400m-relay',
                'description' => 'Four athletes, four laps total with baton.',
                'sort_order' => 18,
                'is_active' => true,
            ],
        ];

        foreach ($classes as $class) {
            VehicleClass::updateOrCreate(
                ['slug' => $class['slug']],
                $class
            );
        }

        $this->command->info('Track & Field events seeded: ' . count($classes));
    }
}