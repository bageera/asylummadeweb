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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('driver_id')->constrained('drivers')->cascadeOnDelete();
            $table->foreignId('vehicle_class_id')->constrained('vehicle_classes');
            $table->foreignId('team_id')->nullable()->constrained('teams')->nullOnDelete();
            $table->unsignedSmallInteger('car_number');
            $table->string('car_make', 50)->nullable();
            $table->string('car_model', 50)->nullable();
            $table->unsignedSmallInteger('car_year')->nullable();
            $table->string('car_color', 30)->nullable();
            $table->string('transponder_id', 50)->nullable();
            $table->string('pit_pass_number', 50)->nullable();
            $table->boolean('checked_in')->default(false);
            $table->timestamp('check_in_time')->nullable();
            $table->boolean('paid')->default(false);
            $table->string('payment_method', 20)->nullable();
            $table->string('payment_reference', 100)->nullable();
            $table->text('withdrawal_reason')->nullable();
            $table->enum('status', ['registered', 'checked_in', 'withdrawn', 'no_show'])->default('registered');
            $table->timestamps();

            $table->unique(['event_id', 'driver_id', 'vehicle_class_id']);
            $table->index('event_id');
            $table->index('driver_id');
            $table->index('vehicle_class_id');
            $table->index('team_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};