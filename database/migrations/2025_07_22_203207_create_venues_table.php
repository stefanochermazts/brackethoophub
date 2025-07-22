<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome della palestra/campo
            $table->text('address'); // Indirizzo completo
            $table->string('city'); // Città
            $table->string('postal_code', 10)->nullable(); // CAP
            $table->string('phone', 20)->nullable(); // Telefono struttura
            $table->text('description')->nullable(); // Descrizione e note
            $table->json('facilities')->nullable(); // Servizi disponibili (parcheggio, bar, spogliatoi, ecc.)
            $table->integer('capacity')->nullable(); // Capienza spettatori
            $table->decimal('latitude', 10, 8)->nullable(); // Coordinate GPS
            $table->decimal('longitude', 11, 8)->nullable();
            $table->foreignId('tournament_id')->constrained('tournaments')->onDelete('cascade'); // Torneo di appartenenza
            $table->json('availability')->nullable(); // Orari disponibilità per giorno (es. {"monday": ["09:00-12:00", "14:00-18:00"]})
            $table->boolean('is_active')->default(true); // Palestra attiva/disattiva
            $table->timestamps();
            
            $table->index('tournament_id');
            $table->index(['city', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};
