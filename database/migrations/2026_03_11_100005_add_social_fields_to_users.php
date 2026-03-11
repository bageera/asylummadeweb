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
            // Social login fields - only add if not exists
            if (!Schema::hasColumn('users', 'google_id')) {
                $table->string('google_id')->nullable()->unique();
            }
            if (!Schema::hasColumn('users', 'facebook_id')) {
                $table->string('facebook_id')->nullable()->unique();
            }
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable();
            }
            
            // Additional profile fields
            if (!Schema::hasColumn('users', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable();
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->string('address')->nullable();
            }
            if (!Schema::hasColumn('users', 'city')) {
                $table->string('city')->nullable();
            }
            if (!Schema::hasColumn('users', 'state')) {
                $table->string('state', 2)->nullable();
            }
            if (!Schema::hasColumn('users', 'zip')) {
                $table->string('zip', 10)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [];
            
            if (Schema::hasColumn('users', 'google_id')) {
                $columns[] = 'google_id';
            }
            if (Schema::hasColumn('users', 'facebook_id')) {
                $columns[] = 'facebook_id';
            }
            if (Schema::hasColumn('users', 'avatar')) {
                $columns[] = 'avatar';
            }
            if (Schema::hasColumn('users', 'date_of_birth')) {
                $columns[] = 'date_of_birth';
            }
            if (Schema::hasColumn('users', 'address')) {
                $columns[] = 'address';
            }
            if (Schema::hasColumn('users', 'city')) {
                $columns[] = 'city';
            }
            if (Schema::hasColumn('users', 'state')) {
                $columns[] = 'state';
            }
            if (Schema::hasColumn('users', 'zip')) {
                $columns[] = 'zip';
            }
            
            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};