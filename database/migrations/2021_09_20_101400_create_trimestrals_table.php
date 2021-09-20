<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrimestralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trimestrals', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_estudante')->unsigned()->index();
            $table->bigInteger('id_disciplina')->unsigned()->index();
            $table->bigInteger('epoca');
            $table->decimal('av1', 4, 2)->nullable();
            $table->date('av1_data')->nullable();
            $table->decimal('av2', 4, 2)->nullable();
            $table->date('av2_data')->nullable();
            $table->decimal('av3', 4, 2)->nullable();
            $table->date('av3_data')->nullable();
            $table->decimal('mac', 4, 2)->nullable();
            $table->decimal('npp', 4, 2)->nullable();
            $table->date('npp_data')->nullable();
            $table->decimal('pt', 4, 2)->nullable();
            $table->date('pt_data')->nullable();
            $table->decimal('mt', 4, 2)->nullable();
            $table->string('estado');
            $table->string('ano_lectivo');
            $table->timestamps();
        });

        Schema::table('trimestrals', function (Blueprint $table) {
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
        Schema::dropIfExists('trimestrals');
    }
}