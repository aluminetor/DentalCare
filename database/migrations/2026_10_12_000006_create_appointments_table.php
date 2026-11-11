<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->restrictOnDelete();
            $table->foreignId('dentist_id')->constrained('users')->restrictOnDelete();   // user with Dentist role
            $table->date('date');
            $table->time('time');
            $table->string('reason', 200);
            $table->string('status', 15)->default('Pending');   // Pending / Confirmed / Completed / Cancelled
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
