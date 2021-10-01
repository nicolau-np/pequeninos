<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservacaoConjuntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observacao_conjuntas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_curso')->unsigned()->index();
            $table->bigInteger('id_classe')->unsigned()->index();
            $table->string('estado');
            $table->timestamps();
        });

        Schema::table('observacao_conjuntas', function (Blueprint $table) {
            $table->foreign('id_curso')->references('id')->on('cursos')->onUpdate('cascade');
            $table->foreign('id_classe')->references('id')->on('classes')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observacao_conjuntas');
    }
}