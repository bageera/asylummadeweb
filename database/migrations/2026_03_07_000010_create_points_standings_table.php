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
        Schema::create('points_standings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')->constrained('seasons')->cascadeOnDelete();
            $table->foreignId('vehicle_class_id')->constrained('vehicle_classes');
            $table->foreignId('driver_id')->constrained('drivers')->cascadeOnDelete();

            // Stats
            $table->unsignedTinyInteger('events_participated')->default(0);
            $table->unsignedTinyInteger('events_counted')->default(0); // For drop weeks
            $table->unsignedTinyInteger('wins')->default(0);
            $table->unsignedTinyInteger('top5')->default(0);
            $table->unsignedTinyInteger('top10')->default(0);
            $table->unsignedTinyInteger('poles')->default(0);
            $table->unsignedSmallInteger('laps_led')->default(0);

            // Points
            $table->unsignedSmallInteger('total_points')->default(0);
            $table->unsignedSmallInteger('adjusted_points')->default(0); // After drops

            // Position
            $table->unsignedSmallInteger('position')->default(0);
            $table->unsignedSmallInteger('previous_position')->nullable();

            $table->timestamps();

            $table->unique(['season_id', 'vehicle_class_id', 'driver_id']);
            $table->index('season_id');
            $table->index('vehicle_class_id');
            $table->index('driver_id');
            $table->index('position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points_standings');
    }
};