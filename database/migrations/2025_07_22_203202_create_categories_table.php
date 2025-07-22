<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome della categoria (es. "Under 18", "Senior", "Esordienti")
            $table->text('description')->nullable(); // Descrizione della categoria
            $table->integer('min_age')->nullable(); // Età minima
            $table->integer('max_age')->nullable(); // Età massima
            $table->enum('gender', ['male', 'female', 'mixed']); // Sesso specifico per la categoria
            $table->foreignId('tournament_id')->constrained('tournaments')->onDelete('cascade'); // Torneo di appartenenza
            $table->integer('min_teams')->default(3); // Numero minimo di squadre (default 3)
            $table->integer('max_teams')->nullable(); // Numero massimo di squadre
            $table->enum('format', ['round_robin', 'knockout', 'mixed']); // Formula specifica per la categoria
            $table->json('rules')->nullable(); // Regole specifiche della categoria
            $table->timestamps();
            
            $table->index('tournament_id');
            $table->unique(['tournament_id', 'name']); // Nome categoria unico per torneo
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
