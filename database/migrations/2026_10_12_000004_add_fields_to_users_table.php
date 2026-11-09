<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Extends the default Laravel users table with the required domain columns.
        Schema::table('users', function (Blueprint $table) {
            $table->string('name', 60)->change();
            $table->string('email', 100)->change();
            $table->string('last_name', 60)->after('name');
            $table->string('phone', 20)->nullable()->after('password');
            $table->string('specialty', 80)->nullable()->after('phone');   // dentists only
            $table->foreignId('role_id')->after('specialty')->constrained('roles')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('role_id');
            $table->dropColumn(['last_name', 'phone', 'specialty']);
        });
    }
};
