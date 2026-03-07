<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;
use App\Models\VehicleClass;
use App\Models\Event;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $season = Season::where('slug', '2026')->first();

        if (!$season) {
            $this->command->error('Run SeasonSeeder first!');
            return;
        }

        $streetStock = VehicleClass::where('slug', 'street-stock')->first();
        $pureStock = VehicleClass::where('slug', 'pure-stock')->first();
        $modified = VehicleClass::where('slug', 'modified')->first();
        $miniStock = VehicleClass::where('slug', 'mini-stock')->first();

        $events = [
            [
                'name' => 'Season Opener',
                'event_date' => '2026-03-14',
                'gates_open_time' => '16:00:00',
                'practice_start_time' => '17:00:00',
                'racing_start_time' => '19:00:00',
                'admission_general' => 15.00,
                'admission_pit' => 25.00,
                'admission_kids' => 5.00,
                'status' => 'registration_open',
                'classes' => [$streetStock?->id, $pureStock?->id, $miniStock?->id, $modified?->id],
            ],
            [
                'name' => 'Spring Showdown',
                'event_date' => '2026-03-21',
                'gates_open_time' => '16:00:00',
                'practice_start_time' => '17:00:00',
                'racing_start_time' => '19:00:00',
                'admission_general' => 15.00,
                'admission_pit' => 25.00,
                'admission_kids' => 5.00,
                'status' => 'scheduled',
                'classes' => [$streetStock?->id, $pureStock?->id, $miniStock?->id],
            ],
            [
                'name' => 'April Fools Race Night',
                'event_date' => '2026-04-04',
                'gates_open_time' => '16:00:00',
                'practice_start_time' => '17:00:00',
                'racing_start_time' => '19:00:00',
                'admission_general' => 15.00,
                'admission_pit' => 25.00,
                'admission_kids' => 5.00,
                'status' => 'scheduled',
                'classes' => [$streetStock?->id, $pureStock?->id, $miniStock?->id, $modified?->id],
            ],
        ];

        foreach ($events as $eventData) {
            $classes = $eventData['classes'] ?? [];
            unset($eventData['classes']);

            $event = Event::updateOrCreate(
                [
                    'season_id' => $season->id,
                    'event_date' => $eventData['event_date'],
                ],
                array_merge($eventData, ['season_id' => $season->id])
            );

            // Attach classes with pivot data
            foreach (array_filter($classes) as $index => $classId) {
                $event->vehicleClasses()->syncWithoutDetaching([
                    $classId => [
                        'laps' => 20,
                        'entry_fee' => 35.00,
                        'sort_order' => $index + 1,
                    ],
                ]);
            }
        }

        $this->command->info('Demo events seeded: ' . count($events));
    }
}