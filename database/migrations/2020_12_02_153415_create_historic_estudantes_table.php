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
            $table->bigInteger('numero')->nullable();
            $table->string('numero_acesso')->nullable();
            $table->string('categoria')->nullable();
            $table->string('estado');
            $table->string('observacao_final')->nullable();
            $table->string('obs_pauta')->nullable();
            $table->string('ano_lectivo');
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
