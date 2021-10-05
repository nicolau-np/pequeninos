<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjaNotaFinalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eja_nota_finals', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_estudante')->unsigned()->index();
            $table->bigInteger('id_disciplina')->unsigned()->index();
            $table->decimal('media', 4,2)->nullable();
            $table->decimal('nf', 4,0)->nullable();
            $table->string('estado');
            $table->string('ano_lectivo');
            $table->timestamps();
        });

        Schema::table('eja_nota_finals', function (Blueprint $table){
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
        Schema::dropIfExists('eja_nota_finals');
    }
}