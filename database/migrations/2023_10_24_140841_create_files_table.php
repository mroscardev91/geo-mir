<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();  // id (PK autoincremental)
            $table->string('filepath'); // filepath (cadena)
            $table->integer('filesize'); // filesize (enter)
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
};
