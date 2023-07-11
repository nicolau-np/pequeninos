<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuloFinalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulo_finals', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('id_estudante')->unsigned()->index();
            $table->bigInteger('id_disciplina')->unsigned()->index();
            $table->bigInteger('id_turma')->nullable();
            $table->decimal('ms1', 4, 2)->nullable();
            $table->decimal('ms2', 4, 2)->nullable();
            $table->decimal('mfd', 4, 2)->nullable();
            $table->decimal('exame', 4, 2)->nullable();
            $table->decimal('mf', 4, 0)->nullable();
            $table->string('obs')->nullable();
            $table->string('ano_lectivo')->nullable();
            $table->timestamps();
        });

        Schema::table('modulo_finals', function (Blueprint $table) {
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
        Schema::dropIfExists('modulo_finals');
    }
}
