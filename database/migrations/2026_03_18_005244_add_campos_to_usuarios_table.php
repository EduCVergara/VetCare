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
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('telefono')->nullable();
            $table->string('cargo')->nullable();
            $table->enum('rol', ['admin', 'veterinario', 'recepcionista', 'visor'])->default('recepcionista');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn(['telefono', 'cargo', 'rol']);
        });
    }
};
