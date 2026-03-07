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
        User::updateOrCreate(
            ['email' => 'admin@asylummadetrack.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('changeme'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin user created: admin@asylummadetrack.com');
        $this->command->warn('Password: changeme (change immediately!)');
    }
}