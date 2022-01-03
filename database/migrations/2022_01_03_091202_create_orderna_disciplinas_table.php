<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdernaDisciplinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderna_disciplinas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_curso')->unsigned()->index();
            $table->bigInteger('id_classe')->unsigned()->index();
            $table->bigInteger('id_disciplina')->unsigned()->index();
            $table->string('estado');
            $table->timestamps();
        });

        Schema::table('orderna_disciplinas', function (Blueprint $table) {
            $table->foreign('id_curso')->references('id')->on('cursos')->onUpdate('cascade');
            $table->foreign('id_classe')->references('id')->on('classes')->onUpdate('cascade');
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
        Schema::dropIfExists('orderna_disciplinas');
    }
}