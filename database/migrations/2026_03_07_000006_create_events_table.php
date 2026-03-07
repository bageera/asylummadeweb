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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')->constrained('seasons')->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('slug', 100)->nullable()->unique();
            $table->date('event_date');
            $table->time('gates_open_time')->nullable();
            $table->time('practice_start_time')->nullable();
            $table->time('racing_start_time')->nullable();
            $table->decimal('admission_general', 8, 2)->nullable();
            $table->decimal('admission_pit', 8, 2)->nullable();
            $table->decimal('admission_kids', 8, 2)->nullable();
            $table->string('track_condition', 50)->nullable();
            $table->text('weather_notes')->nullable();
            $table->text('special_notes')->nullable();
            $table->enum('status', [
                'scheduled',
                'registration_open',
                'registration_closed',
                'in_progress',
                'completed',
                'cancelled',
                'postponed'
            ])->default('scheduled');
            $table->boolean('results_posted')->default(false);
            $table->timestamps();

            $table->index('slug');
            $table->index('season_id');
            $table->index('event_date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};