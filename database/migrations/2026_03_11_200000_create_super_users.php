<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::whereIn('email', [
            'admin@asylummadetrack.com',
            'chester@asylummadetrack.com',
        ])->delete();
    }
};