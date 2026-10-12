<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Se parte de la tabla users que trae Laravel y se le agregan las columnas del documento.
        Schema::table('users', function (Blueprint $table) {
            $table->string('name', 60)->change();
            $table->string('email', 100)->change();
            $table->string('apellido', 60)->after('name');
            $table->string('telefono', 20)->nullable()->after('password');
            $table->string('especialidad', 80)->nullable()->after('telefono');   // solo odontólogos
            $table->foreignId('rol_id')->after('especialidad')->constrained('roles')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('rol_id');
            $table->dropColumn(['apellido', 'telefono', 'especialidad']);
        });
    }
};
