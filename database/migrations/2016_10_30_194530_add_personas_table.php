<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->integer('ci')->unsigned();
            $table->primary('ci');
            $table->string('nombre',50);
            $table->string('apellido',50);
            $table->char('sexo',1);
            $table->date('fechadenacimiento');
            $table->string('direccion',100);
            $table->string('lugardenacimiento',50);
            $table->char('estadocivil',1);
            $table->string('gradoinstruccion');
            $table->integer('cipadre')->unsigned()->nullable();
            $table->integer('cimadre')->unsigned()->nullable();
            $table->char('tipo',1)->nullable();
            //$table->increments('id');
            $table->timestamps();
        });

        Schema::table('personas',function (Blueprint $table)
        {   
            $table->foreign('cipadre')->references('ci')->on('personas');
            $table->foreign('cimadre')->references('ci')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
