<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjaNotaMensalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eja_nota_mensals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_estudante')->unsigned()->index();
            $table->bigInteger('id_disciplina')->unsigned()->index();
            //primeiro semana
            $table->decimal('tpc1',4,1)->nullable();
            $table->decimal('oc1',4,1)->nullable();
            $table->decimal('pg1',4,1)->nullable();
            $table->decimal('pa1',4,1)->nullable();
            $table->decimal('tp1',4,1)->nullable();
            //segundo semana
            $table->decimal('tpc2',4,1)->nullable();
            $table->decimal('oc2',4,1)->nullable();
            $table->decimal('pg2',4,1)->nullable();
            $table->decimal('pa2',4,1)->nullable();
            $table->decimal('tp2',4,1)->nullable();
            //terceiro semana
            $table->decimal('tpc3',4,1)->nullable();
            $table->decimal('oc3',4,1)->nullable();
            $table->decimal('pg3',4,1)->nullable();
            $table->decimal('pa3',4,1)->nullable();
            $table->decimal('tp3',4,1)->nullable();
            //quarta semana
            $table->decimal('tpc4',4,1)->nullable();
            $table->decimal('oc4',4,1)->nullable();
            $table->decimal('pg4',4,1)->nullable();
            $table->decimal('pa4',4,1)->nullable();
            $table->decimal('tp4',4,1)->nullable();
            //media mes
            $table->decimal('tpc_media',4,1)->nullable();
            $table->decimal('oc_media',4,1)->nullable();
            $table->decimal('pg_media',4,1)->nullable();
            $table->decimal('pa_media',4,1)->nullable();
            $table->decimal('tp_media',4,1)->nullable();

            $table->bigInteger('epoca');
            $table->string('estado');
            $table->string('ano_lectivo');
            $table->timestamps();
        });

        Schema::table('eja_nota_mensals', function (Blueprint $table) {
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
        Schema::dropIfExists('eja_nota_mensals');
    }
}
