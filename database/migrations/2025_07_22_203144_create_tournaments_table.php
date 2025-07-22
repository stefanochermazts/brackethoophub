<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome del torneo
            $table->text('description')->nullable(); // Descrizione opzionale
            $table->enum('gender', ['male', 'female', 'mixed']); // Sesso del torneo
            $table->date('start_date'); // Data inizio
            $table->date('end_date'); // Data fine
            $table->enum('status', ['draft', 'published', 'ongoing', 'completed', 'cancelled'])->default('draft'); // Stato del torneo
            $table->enum('format', ['round_robin', 'knockout', 'mixed']); // Formula del torneo
            $table->json('settings')->nullable(); // Impostazioni specifiche (durata tempi, regole, ecc.)
            $table->foreignId('organizer_id')->constrained('users'); // Chi ha creato il torneo
            $table->timestamps();
            
            $table->index(['organizer_id', 'status']);
            $table->index('start_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
