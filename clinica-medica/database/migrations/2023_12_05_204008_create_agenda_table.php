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
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->string('horario');
            $table->unsignedBigInteger('paciente');
            $table->foreign('paciente')->references('codigo')->on('paciente');
            $table->unsignedBigInteger('medico');
            $table->foreign('medico')->references('codigo')->on('medico');
            $table->timestamps();
            $table->timestamp('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};
