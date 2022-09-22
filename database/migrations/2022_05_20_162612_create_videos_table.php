<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('descripcion');
            $table->string('url'); //Clave que genera vimeo o youtube
            $table->string('iframe')->nullable();
            $table->string('miniatura')->nullable();
            $table->enum('portada', ['si', 'no'])->default('no');
            $table->enum('disponible', ['si', 'no'])->default('si');
            $table->integer('vistas', false, true)->default(0);

            //Llave foranea con canal
            $table->unsignedBigInteger('canal_id');
            $table->foreign('canal_id')->references('id')->on('canals')->onDelete('cascade');
            //Llave foranea con plataforma
            $table->unsignedBigInteger('plataforma_id')->nullable();
            $table->foreign('plataforma_id')->references('id')->on('plataformas')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
};
