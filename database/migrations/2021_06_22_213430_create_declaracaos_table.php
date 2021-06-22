<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclaracaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declaracaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_estudante')->unsigned()->index();
            $table->string('tipo');
            $table->string('ano_lectivo');
            $table->date('data_emissao');
            $table->timestamps();
        });

        Schema::table('declaracaos', function (Blueprint $table) {
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
        Schema::dropIfExists('declaracaos');
    }
}