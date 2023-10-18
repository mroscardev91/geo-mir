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
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // columna id, clave primaria y autoincremental
            $table->string('name')->unique(); // columna name con restricción de unicidad
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable(); // columna role_id con opción de valores null
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            // clave foránea para relacionar role_id con id de la tabla roles
        });
         
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Eliminar la clave foránea
        $table->dropForeign(['role_id']);
        // Eliminar la columna role_id
        $table->dropColumn('role_id');
    });

    // Eliminar la tabla roles
    Schema::dropIfExists('roles');
}
};
