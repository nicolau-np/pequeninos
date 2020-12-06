<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_tipo_sala')->unsigned()->index();
            $table->bigInteger('quant_estudantes');
            $table->string('sala');
            $table->timestamps();
        });

        Schema::table('salas', function (Blueprint $table) {
            $table->foreign('id_tipo_sala')->references('id')->on('tipo_salas')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salas');
    }
}