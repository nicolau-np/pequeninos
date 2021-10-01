<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudantes', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_turma')->unsigned()->index();
            $table->bigInteger('id_pessoa')->unsigned()->index();
            $table->bigInteger('id_encarregado')->unsigned()->index();
            $table->bigInteger('numero')->nullable();
            $table->string('estado');
            $table->string('ano_lectivo');
            $table->timestamps();
        });

        Schema::table('estudantes', function (Blueprint $table) {
            $table->foreign('id_turma')->references('id')->on('turmas')->onUpdate('cascade');
            $table->foreign('id_pessoa')->references('id')->on('pessoas')->onUpdate('cascade');
            $table->foreign('id_encarregado')->references('id')->on('encarregados')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudantes');
    }
}
