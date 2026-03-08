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

        // Get track & field events
        $sprint100 = VehicleClass::where('slug', '100m-sprint')->first();
        $sprint200 = VehicleClass::where('slug', '200m-sprint')->first();
        $sprint400 = VehicleClass::where('slug', '400m-sprint')->first();
        $distance800 = VehicleClass::where('slug', '800m-run')->first();
        $distance1600 = VehicleClass::where('slug', '1600m-run')->first();
        $longJump = VehicleClass::where('slug', 'long-jump')->first();
        $highJump = VehicleClass::where('slug', 'high-jump')->first();
        $shotPut = VehicleClass::where('slug', 'shot-put')->first();
        $discus = VehicleClass::where('slug', 'discus')->first();
        $relay4x100 = VehicleClass::where('slug', '4x100m-relay')->first();

        $events = [
            [
                'name' => 'Season Opener Meet',
                'event_date' => '2026-03-14',
                'gates_open_time' => '08:00:00',
                'practice_start_time' => '09:00:00',
                'racing_start_time' => '10:00:00',
                'admission_general' => 5.00,
                'admission_pit' => null,
                'admission_kids' => 0.00,
                'status' => 'registration_open',
                'special_notes' => 'Opening meet of the 2026 season. All age divisions welcome.',
                'events' => [$sprint100?->id, $sprint200?->id, $sprint400?->id, $longJump?->id, $shotPut?->id],
            ],
            [
                'name' => 'Spring Sprint Classic',
                'event_date' => '2026-03-28',
                'gates_open_time' => '08:00:00',
                'practice_start_time' => '09:00:00',
                'racing_start_time' => '10:00:00',
                'admission_general' => 5.00,
                'admission_kids' => 0.00,
                'status' => 'scheduled',
                'special_notes' => 'Focus on sprint events with field competitions.',
                'events' => [$sprint100?->id, $sprint200?->id, $sprint400?->id, $longJump?->id, $highJump?->id],
            ],
            [
                'name' => 'Distance & Throws Meet',
                'event_date' => '2026-04-11',
                'gates_open_time' => '08:00:00',
                'practice_start_time' => '09:00:00',
                'racing_start_time' => '10:00:00',
                'admission_general' => 5.00,
                'admission_kids' => 0.00,
                'status' => 'scheduled',
                'special_notes' => 'Mid-distance and throwing events featured.',
                'events' => [$distance800?->id, $distance1600?->id, $shotPut?->id, $discus?->id],
            ],
            [
                'name' => 'All-Around Championship',
                'event_date' => '2026-04-25',
                'gates_open_time' => '08:00:00',
                'practice_start_time' => '09:00:00',
                'racing_start_time' => '10:00:00',
                'admission_general' => 7.00,
                'admission_kids' => 0.00,
                'status' => 'scheduled',
                'special_notes' => 'Full event schedule — sprints, distance, jumps, throws.',
                'events' => [$sprint100?->id, $sprint200?->id, $sprint400?->id, $distance800?->id, $longJump?->id, $shotPut?->id, $relay4x100?->id],
            ],
        ];

        foreach ($events as $eventData) {
            $eventIds = $eventData['events'] ?? [];
            unset($eventData['events']);

            $event = Event::updateOrCreate(
                [
                    'season_id' => $season->id,
                    'event_date' => $eventData['event_date'],
                ],
                array_merge($eventData, ['season_id' => $season->id])
            );

            // Attach events to meet
            foreach (array_filter($eventIds) as $index => $eventId) {
                $event->vehicleClasses()->syncWithoutDetaching([
                    $eventId => [
                        'sort_order' => $index + 1,
                    ],
                ]);
            }
        }

        $this->command->info('Demo meets seeded: ' . count($events));
    }
}