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
        Schema::create('paciente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('codigo');
            $table->foreign('codigo')->references('id')->on('users');
            $table->integer('peso');
            $table->decimal('altura', 8, 2);
            $table->string('tipo_sanguineo', 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paciente');
    }
};
