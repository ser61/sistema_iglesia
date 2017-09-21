<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVersionesencuentroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versionesencuentro', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->integer('cimiembro')->unsigned();
            $table->integer('idencuentro')->unsigned();
            $table->primary(['id','cimiembro','idencuentro']);

            $table->date('fecha');
            $table->string('lugar',50);


            $table->foreign('cimiembro')
                ->references('ci')
                ->on('miembros')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('idencuentro')
                ->references('id')
                ->on('encuentros')
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
        Schema::dropIfExists('versionesencuentro');
    }
}
