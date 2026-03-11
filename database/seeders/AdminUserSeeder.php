<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

        // Create Chester as super_user (track owner)
        User::updateOrCreate(
            ['email' => 'chester@asylummadetrack.com'],
            [
                'name' => 'Chester',
                'password' => Hash::make('AsylumTrack2024!'),
                'role' => 'super_user',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Super users created:');
        $this->command->line('  - admin@asylummadetrack.com (Password: AsylumAdmin2024!)');
        $this->command->line('  - chester@asylummadetrack.com (Password: AsylumTrack2024!)');
    }
}