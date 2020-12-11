<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Block\Element\IndentedCode;

class CreateDirectorTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('director_turmas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_funcionario')->unsigned()->index();
            $table->bigInteger('id_turma')->unsigned()->index();
            $table->bigInteger('ano_lectivo');
            $table->timestamps();
        });

        Schema::table('director_turmas', function (Blueprint $table) {
            $table->foreign('id_funcionario')->references('id')->on('funcionarios')->onUpdate('cascade');
            $table->foreign('id_turma')->references('id')->on('turmas')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('director_turmas');
    }
}