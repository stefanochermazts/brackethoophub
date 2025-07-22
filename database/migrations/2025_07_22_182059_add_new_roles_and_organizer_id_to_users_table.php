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
            // Aggiungi il campo per l'organizzatore padre
            $table->unsignedBigInteger('organizer_id')->nullable()->after('role');
            $table->foreign('organizer_id')->references('id')->on('users')->onDelete('cascade');
            
            // Aggiungi un indice per migliorare le performance delle query
            $table->index(['role', 'organizer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['organizer_id']);
            $table->dropIndex(['role', 'organizer_id']);
            $table->dropColumn('organizer_id');
        });
    }
};
