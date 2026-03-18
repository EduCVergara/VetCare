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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete();
            $table->string('nombre');
            $table->enum('especie', ['Perro', 'Gato', 'Ave', 'Otro']);
            $table->string('raza')->nullable();
            $table->integer('edad')->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->string('microchip')->nullable()->unique();
            $table->date('ultima_visita')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
