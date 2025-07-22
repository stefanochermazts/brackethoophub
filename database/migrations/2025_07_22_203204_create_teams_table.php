<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome della squadra
            $table->string('short_name', 20)->nullable(); // Nome abbreviato per tabelloni
            $table->text('description')->nullable(); // Descrizione della squadra
            $table->string('logo_path')->nullable(); // Path del logo della squadra
            $table->string('primary_color', 7)->nullable(); // Colore primario (hex)
            $table->string('secondary_color', 7)->nullable(); // Colore secondario (hex)
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Categoria di appartenenza
            $table->foreignId('company_id')->nullable()->constrained('users'); // Società proprietaria (user con ruolo company)
            $table->foreignId('coach_id')->nullable()->constrained('users'); // Allenatore principale (user con ruolo coach)
            $table->enum('status', ['registered', 'confirmed', 'withdrawn', 'disqualified'])->default('registered'); // Stato iscrizione
            $table->timestamp('registration_date')->useCurrent(); // Data iscrizione
            $table->json('contact_info')->nullable(); // Info contatto (telefono, email referente)
            $table->timestamps();
            
            $table->index('category_id');
            $table->index(['company_id', 'status']);
            $table->unique(['category_id', 'name']); // Nome squadra unico per categoria
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
