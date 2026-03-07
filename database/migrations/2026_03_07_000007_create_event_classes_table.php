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
        Schema::create('event_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('vehicle_class_id')->constrained('vehicle_classes')->cascadeOnDelete();
            $table->unsignedTinyInteger('laps')->default(20);
            $table->decimal('purse', 10, 2)->nullable();
            $table->decimal('entry_fee', 8, 2)->default(0);
            $table->boolean('heat_race')->default(false);
            $table->unsignedTinyInteger('feature_laps')->nullable();
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['event_id', 'vehicle_class_id']);
            $table->index('event_id');
            $table->index('vehicle_class_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_classes');
    }
};