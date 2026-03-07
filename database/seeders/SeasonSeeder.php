<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seasons = [
            [
                'name' => '2026 Season',
                'slug' => '2026',
                'year' => 2026,
                'start_date' => '2026-03-01',
                'end_date' => '2026-11-30',
                'is_current' => true,
                'points_system' => 'standard',
                'status' => 'active',
            ],
        ];

        foreach ($seasons as $season) {
            Season::updateOrCreate(
                ['slug' => $season['slug']],
                $season
            );
        }

        $this->command->info('Seasons seeded: ' . count($seasons));
    }
}