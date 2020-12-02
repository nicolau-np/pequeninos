<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_cargo')->unsigned()->index();
            $table->bigInteger('id_escalao')->unsigned()->index();
            $table->bigInteger('id_pessoa')->unsigned()->index();
            $table->string('estado')->nullable();
            $table->timestamps();
        });

        Schema::table('funcionarios', function (Blueprint $table) {
            $table->foreign('id_cargo')->references('id')->on('cargos')->onUpdate('cascade');
            $table->foreign('id_escalao')->references('id')->on('escalaos')->onUpdate('cascade');
            $table->foreign('id_pessoa')->references('id')->on('pessoas')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
}