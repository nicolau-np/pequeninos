<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvaliacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacaos', function (Blueprint $table) {
            $table->engine = "InnoDB";
             $table->bigIncrements('id');
             $table->bigInteger('id_estudante')->unsigned()->index();
             $table->bigInteger('id_disciplina')->unsigned()->index();
             $table->bigInteger('epoca');
             $table->decimal('valo1', 4,2)->nullable();
             $table->date('data1', 4,2)->nullable();
             $table->decimal('valo2', 4,2)->nullable();
             $table->date('data2', 4,2)->nullable();
             $table->decimal('valo3', 4,2)->nullable();
             $table->date('data3', 4,2)->nullable();
             $table->string('ano_lectivo');
             $table->timestamps();
         });
 
         Schema::table('avaliacaos', function (Blueprint $table) {
             $table->foreign('id_estudante')->references('id')->on('estudantes')->onUpdate('cascade');
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
        Schema::dropIfExists('avaliacaos');
    }
}