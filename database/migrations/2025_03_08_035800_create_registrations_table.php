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
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_class_id')->constrained()->onDelete('cascade');
            $table->foreignId('team_id')->nullable()->constrained()->onDelete('set null');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->date('date_of_birth');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->enum('status', ['pending', 'approved', 'rejected', 'checked_in'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamp('agreed_rules_at')->nullable();
            $table->timestamp('agreed_waiver_at')->nullable();
            $table->timestamp('agreed_safety_at')->nullable();
            $table->timestamps();

            $table->index(['event_id', 'status']);
            $table->index(['email']);
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