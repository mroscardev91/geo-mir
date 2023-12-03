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
        
        Schema::create('visibilities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
       
        Artisan::call('db:seed', [
            '--class' => 'VisibilitySeeder',
            '--force' => true
         ]);         

        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('visibility_id')->nullable();
            $table->foreign('visibility_id')->references('id')->on('visibilities');
        });

        Schema::table('places', function (Blueprint $table) {
            $table->unsignedBigInteger('visibility_id')->nullable();
            $table->foreign('visibility_id')->references('id')->on('visibilities');
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Eliminar la clave foránea de la tabla 'posts'
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['visibility_id']);
            $table->dropColumn('visibility_id');
        });

        Schema::table('places', function (Blueprint $table) {
            $table->dropForeign(['visibility_id']);
            $table->dropColumn('visibility_id');
        });

        // Eliminar la tabla 'roles'
        Schema::dropIfExists('visibilities');
         
    }
};
