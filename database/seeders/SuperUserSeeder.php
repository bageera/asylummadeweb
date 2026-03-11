<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Chester as super_user
        User::updateOrCreate(
            ['email' => 'chester@asylummadetrack.com'],
            [
                'name' => 'Chester',
                'password' => Hash::make('AsylumTrack2024!'),
                'role' => 'super_user',
                'email_verified_at' => now(),
                'phone' => null,
                'emergency_contact' => null,
                'emergency_phone' => null,
            ]
        );

        // Create admin as super_user (for system administration)
        User::updateOrCreate(
            ['email' => 'admin@asylummadetrack.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('AsylumAdmin2024!'),
                'role' => 'super_user',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Super users created successfully.');
    }
}
