<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrerequisitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prerequisitos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idencuentro')->unsigned();
            $table->integer('idprerequisito')->unsigned();

            $table->foreign('idencuentro')
                ->references('id')->on('encuentros')->onDelete('no action')->onUpdate('no action');

            $table->foreign('idprerequisito')
                ->references('id')->on('encuentros')->onDelete('no action')->onUpdate('no action');

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
        Schema::dropIfExists('prerequisitos');
    }
}
