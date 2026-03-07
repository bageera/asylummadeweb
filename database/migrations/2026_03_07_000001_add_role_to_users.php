<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'official', 'team_manager', 'driver'])
                ->default('driver')
                ->after('email');
            $table->string('phone', 20)->nullable()->after('role');
            $table->string('emergency_contact', 100)->nullable()->after('phone');
            $table->string('emergency_phone', 20)->nullable()->after('emergency_contact');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'emergency_contact', 'emergency_phone']);
        });
    }
};