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
        Schema::create('prontuario_eletronico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('codigo');
            $table->foreign('codigo')->references('codigo')->on('paciente');
            $table->longText('anamnese');
            $table->longText('medicamentos');
            $table->longText('atestados');
            $table->longText('exames');
            $table->timestamps();
            $table->timestamp('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prontuario_eletronico');
    }
};
