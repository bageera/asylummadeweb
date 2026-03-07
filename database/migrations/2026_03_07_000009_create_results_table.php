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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('vehicle_class_id')->constrained('vehicle_classes');
            $table->foreignId('driver_id')->constrained('drivers')->cascadeOnDelete();
            $table->foreignId('registration_id')->nullable()->constrained('registrations')->nullOnDelete();

            // Finishing Info
            $table->unsignedTinyInteger('finish_position');
            $table->unsignedTinyInteger('starting_position')->nullable();
            $table->unsignedSmallInteger('laps_completed')->nullable();
            $table->unsignedSmallInteger('laps_led')->nullable();
            $table->string('finishing_time', 20)->nullable();
            $table->string('interval_ahead', 20)->nullable();
            $table->string('interval_leader', 20)->nullable();
            $table->string('best_lap_time', 20)->nullable();
            $table->unsignedSmallInteger('best_lap_number')->nullable();
            $table->decimal('average_speed', 6, 2)->nullable();

            // Points
            $table->unsignedTinyInteger('points_awarded')->default(0);
            $table->unsignedTinyInteger('bonus_points')->default(0);
            $table->unsignedTinyInteger('penalty_points')->default(0);
            $table->unsignedTinyInteger('total_points')->default(0);

            // Status
            $table->enum('finish_status', ['running', 'finished', 'dnf', 'dns', 'dq'])->default('finished');
            $table->boolean('dnq')->default(false);
            $table->text('disqualification_reason')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(['event_id', 'vehicle_class_id', 'finish_position']);
            $table->index('event_id');
            $table->index('vehicle_class_id');
            $table->index('driver_id');
            $table->index('finish_position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};