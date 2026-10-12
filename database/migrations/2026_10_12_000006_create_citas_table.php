<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->restrictOnDelete();
            $table->foreignId('odontologo_id')->constrained('users')->restrictOnDelete();   // usuario con rol Odontólogo
            $table->date('fecha');
            $table->time('hora');
            $table->string('motivo', 200);
            $table->string('estado', 15)->default('Pendiente');   // Pendiente / Confirmada / Atendida / Cancelada
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
