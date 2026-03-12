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
            $table->foreignId('athlete_id')->nullable()->constrained('drivers')->cascadeOnDelete();
            $table->foreignId('vehicle_class_id')->constrained('vehicle_classes');
            $table->foreignId('team_id')->nullable()->constrained('teams')->nullOnDelete();
            
            // Athlete info (for guest registrations without athlete profile)
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            
            // Emergency contact
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            
            // Competition info
            $table->unsignedSmallInteger('bib_number')->nullable();
            $table->string('seed_time')->nullable(); // e.g., "11.24" for 100m
            $table->string('seed_distance')->nullable(); // e.g., "6.45m" for long jump
            $table->string('seed_mark')->nullable(); // Generic seed mark
            
            // Check-in & Status
            $table->enum('status', ['pending', 'registered', 'checked_in', 'withdrawn', 'no_show', 'disqualified'])->default('pending');
            $table->boolean('checked_in')->default(false);
            $table->timestamp('check_in_time')->nullable();
            
            // Payment
            $table->boolean('paid')->default(false);
            $table->string('payment_method', 20)->nullable();
            $table->string('payment_reference', 100)->nullable();
            
            // Waivers & Agreements
            $table->timestamp('agreed_rules_at')->nullable();
            $table->timestamp('agreed_waiver_at')->nullable();
            $table->timestamp('agreed_safety_at')->nullable();
            $table->foreignId('waiver_id')->nullable()->constrained('waivers')->nullOnDelete();
            
            // Notes
            $table->text('notes')->nullable();
            $table->text('withdrawal_reason')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('event_id');
            $table->index('athlete_id');
            $table->index('vehicle_class_id');
            $table->index('team_id');
            $table->index('status');
            $table->unique(['event_id', 'athlete_id', 'vehicle_class_id'], 'event_athlete_class_unique');
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