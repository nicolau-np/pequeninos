<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricEstudantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historic_estudantes', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_estudante')->unsigned()->index();
            $table->bigInteger('id_turma')->unsigned()->index();
            $table->string('estado');
            $table->bigInteger('ano_lectivo');
            $table->timestamps();
        });

        Schema::table('historic_estudantes', function (Blueprint $table) {
            $table->foreign('id_turma')->references('id')->on('turmas')->onUpdate('cascade');
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
        Schema::dropIfExists('historic_estudantes');
    }
}