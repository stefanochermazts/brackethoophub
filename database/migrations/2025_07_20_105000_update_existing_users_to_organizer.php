<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing users with role 'user' to 'organizer'
        DB::table('users')
            ->where('role', 'user')
            ->update(['role' => 'organizer']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to 'user' role
        DB::table('users')
            ->where('role', 'organizer')
            ->update(['role' => 'user']);
    }
}; 