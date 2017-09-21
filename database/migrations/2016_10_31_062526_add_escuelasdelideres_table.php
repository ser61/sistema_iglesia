<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEscuelasdelideresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escuelasdelideres', function (Blueprint $table) {
            $table->integer('numero')->unsigned();
            $table->primary('numero');

            $table->integer('cimiembro')->unsigned();

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
        Schema::dropIfExists('escuelasdelideres');
    }
}
