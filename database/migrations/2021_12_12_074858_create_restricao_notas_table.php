<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestricaoNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restricao_notas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_tipo_pagamento')->unsigned()->index();
            $table->bigInteger('id_estudante')->unsigned()->index();
            $table->bigInteger('epoca');
            $table->string('mes');
            $table->bigInteger('mes_numero')->nullable();
            $table->string('ano_lectivo');
            $table->string('estado');
            $table->timestamps();
        });

        Schema::table('restricao_notas', function (Blueprint $table) {
            $table->foreign('id_tipo_pagamento')->references('id')->on('tipo_pagamentos')->onUpdate('cascade');
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
        Schema::dropIfExists('restricao_notas');
    }
}