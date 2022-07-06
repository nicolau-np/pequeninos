<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadeiraExamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadeira_exames', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_curso')->unsigned()->index();
            $table->bigInteger('id_classe')->unsigned()->index();
            $table->bigInteger('id_disciplina')->unsigned()->index();
            $table->string('exame_oral')->nullable();
            $table->string('estado');
            $table->timestamps();
        });

        Schema::table('cadeira_exames', function (Blueprint $table) {
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
        Schema::dropIfExists('cadeira_exames');
    }
}