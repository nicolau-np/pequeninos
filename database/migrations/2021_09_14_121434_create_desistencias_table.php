<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desistencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_estudante')->unsigned()->index();
            $table->text('motivo');
            $table->date('data_saida')->nullable();
            $table->bigInteger('epoca');
            $table->string('ano_lectivo');
            $table->timestamps();
        });

        Schema::table('desistencias', function (Blueprint $table){
            $table->foreign('id_estudante')->references('id')->on('estudantes')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('desistencias');
    }
}