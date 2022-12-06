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
        Schema::create('configs', function (Blueprint $table) {
            $table->id();

            // 
            $table->boolean('urls_amigables')->default(false);
            $table->boolean('comentarios')->default(false);
            $table->boolean('etiquetas')->default(false);
            $table->boolean('admin_listas')->default(false);
            $table->boolean('canal')->default(false);

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
        Schema::dropIfExists('configs');
    }
};
