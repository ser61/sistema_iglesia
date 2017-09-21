<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInformesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('ncelula')->unsigned();
            $table->integer('cilider')->unsigned();
            $table->date('fecha');
            $table->tinyinteger('nronuevos')->unsigned();
            $table->tinyinteger('nrovisitas')->unsigned();
            $table->float('ofrenda')->unsigned();
            $table->timestamps();
        });
        Schema::table('informes',function (Blueprint $table)
        {
            $table->foreign('ncelula')
                ->references('numero')
                ->on('celulas')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('cilider')
                ->references('ci')
                ->on('personas')
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
        Schema::dropIfExists('informes');
    }
}
