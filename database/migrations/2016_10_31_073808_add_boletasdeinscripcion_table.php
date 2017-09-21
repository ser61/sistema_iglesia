<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBoletasdeinscripcionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletasinscripcion', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('numeromodulo')->unsigned();
            $table->integer('cimiembro')->unsigned();
            $table->date('fecha');

            $table->foreign('numeromodulo')
                ->references('id')
                ->on('modulos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('cimiembro')
                ->references('ci')
                ->on('miembros')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('boletasinscripcion');
    }
}
