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
        Schema::create('waiver_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('content'); // Markdown or HTML content
            $table->string('version')->default('1.0');
            $table->boolean('requires_signature')->default(true);
            $table->boolean('requires_parent_signature')->default(false); // For minors
            $table->integer('valid_for_days')->default(365); // Waiver validity period
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('waivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('waiver_template_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->nullable()->constrained()->onDelete('set null');
            $table->text('signature_data'); // Base64 signature image
            $table->string('ip_address', 45);
            $table->string('user_agent')->nullable();
            $table->timestamp('signed_at');
            $table->timestamp('expires_at')->nullable();
            $table->boolean('is_valid')->default(true);
            $table->timestamps();

            $table->index(['user_id', 'waiver_template_id']);
            $table->index(['event_id', 'waiver_template_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waivers');
        Schema::dropIfExists('waiver_templates');
    }
};