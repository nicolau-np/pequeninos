<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservacaoConjuntaRegrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observacao_conjunta_regras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_observacao_conjunta')->unsigned()->index();
            $table->bigInteger('id_disciplina')->unsigned()->index();
            $table->string('estado');
            $table->timestamps();
        });

        Schema::table('observacao_conjunta_regras', function (Blueprint $table){
            $table->foreign('id_observacao_conjunta')->references('id')->on('observacao_conjuntas')->onUpdate('cascade');
            $table->foreign('id_disciplina')->references('id')->on('disciplinas')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observacao_conjunta_regras');
    }
}