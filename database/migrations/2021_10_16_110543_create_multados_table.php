<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multados', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_estudante')->unsigned()->index();
            $table->bigInteger('id_tipo_pagamento')->unsigned()->index();
            $table->bigInteger('mes_multa');
            $table->string('mes');
            $table->bigInteger('percentagem');
            $table->bigInteger('dia_multado');
            $table->string('ano_lectivo');
            $table->string('estado');
            $table->timestamps();
        });

        Schema::table('multados', function (Blueprint $table) {
            $table->foreign('id_estudante')->references('id')->on('estudantes')->onUpdate('cascade');
            $table->foreign('id_tipo_pagamento')->references('id')->on('tipo_pagamentos')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multados');
    }
}