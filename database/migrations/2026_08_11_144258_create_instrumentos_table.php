<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instrumentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('nombre_original')->nullable();
            $table->string('familia');
            $table->string('origen');
            $table->text('historia');
            $table->text('caracteristicas')->nullable();
            $table->text('uso_cultural')->nullable();
            $table->string('imagen')->nullable();
            $table->string('video')->nullable();
            $table->string('audio')->nullable();
            $table->string('imagen_baja_resolucion')->nullable();
            $table->boolean('es_sagrado')->default(false);
            $table->boolean('tiene_visita_virtual')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instrumentos');
    }
};