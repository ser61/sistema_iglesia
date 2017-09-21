<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cimiembro')->unsigned();
            $table->integer('idinforme')->unsigned();

            $table->foreign('cimiembro')
                ->references('ci')
                ->on('miembros')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('idinforme')
                ->references('id')
                ->on('informes')
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
        Schema::dropIfExists('asistencias');
    }
}
