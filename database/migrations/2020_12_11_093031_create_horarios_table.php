<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_funcionario')->unsigned()->index();
            $table->bigInteger('id_turma')->unsigned()->index();
            $table->bigInteger('id_disciplina')->unsigned()->index();
            /*$table->bigInteger('id_sala')->unsigned()->index();
            $table->bigInteger('id_hora')->unsigned()->index();
            $table->string('semana');*/
            $table->string('estado')->nullable();
            $table->string('ano_lectivo');
            $table->timestamps();
        });

        Schema::table('horarios', function (Blueprint $table) {
            $table->foreign('id_funcionario')->references('id')->on('funcionarios')->onUpdate('cascade');
            $table->foreign('id_turma')->references('id')->on('turmas')->onUpdate('cascade');
            $table->foreign('id_disciplina')->references('id')->on('disciplinas')->onUpdate('cascade');
            $table->foreign('id_sala')->references('id')->on('salas')->onUpdate('cascade');
            $table->foreign('id_hora')->references('id')->on('horas')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios');
    }
}