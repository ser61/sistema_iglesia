<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTelefonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefonos', function (Blueprint $table) {
            $table->increments('cod');
            $table->integer('cimiembro')->unsigned();
            $table->integer('numero')->unsigned()->unique();
            $table->string('descripcion',50);
            $table->timestamps();
        });
        Schema::table ('telefonos', function (Blueprint $table)
        {
            $table->foreign('cimiembro')
                ->references('ci')
                ->on('miembros')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefonos');
    }
}
