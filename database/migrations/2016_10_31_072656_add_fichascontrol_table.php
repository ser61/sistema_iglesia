<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFichascontrolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichascontrol', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('nclase')->unsigned();
            $table->integer('cimiembro')->unsigned();
            $table->boolean('asistencia');
            $table->float('nota')->unsigned();

            $table->foreign('nclase')
                ->references('id')
                ->on('clases')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('cimiembro')
                ->references('ci')
                ->on('miembros')->onDelete('cascade');
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
        Schema::dropIfExists('fichascontrol');
    }
}
