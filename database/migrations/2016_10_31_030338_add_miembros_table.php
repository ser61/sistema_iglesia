<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMiembrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miembros', function (Blueprint $table) {
            $table->integer('ci')->unsigned();
            $table->primary('ci');
            $table->date('fechadeconversion');
            $table->integer('idministerio')->unsigned()->nullable();
            $table->integer('idbautismo')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('miembros',function (Blueprint $table)
        {
            $table->foreign('ci')->references('ci')->on('personas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idministerio')->references('id')->on('ministerios')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idbautismo')->references('id')->on('bautismos')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('miembros');
    }
}
