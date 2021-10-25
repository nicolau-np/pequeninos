<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoEntreguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_entregues', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_historico')->unsigned()->index();
            $table->string('documento');
            $table->string('estado');
            $table->timestamps();
        });

        Schema::table('documento_entregues', function (Blueprint $table){
            $table->foreign('id_historico')->references('id')->on('historic_estudantes')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documento_entregues');
    }
}