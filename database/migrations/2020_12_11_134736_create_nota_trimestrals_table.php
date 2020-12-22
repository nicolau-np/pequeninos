<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaTrimestralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_trimestrals', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_estudante')->unsigned()->index();
            $table->bigInteger('id_disciplina')->unsigned()->index();
            $table->bigInteger('epoca');
            $table->decimal('mac', 4,2)->nullable();
            $table->decimal('cpp', 4,2)->nullable();
            $table->decimal('ct', 4,2)->nullable();
            $table->date('data_lancamento')->nullable();
            $table->string('ano_lectivo');
            $table->string('estado')->nullable();
            $table->timestamps();
        });

        Schema::table('nota_trimestrals', function (Blueprint $table) {
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
        Schema::dropIfExists('nota_trimestrals');
    }
}