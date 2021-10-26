<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigBloqueiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_bloqueios', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_bloqueio')->unsigned()->index();
            $table->string('tipo');
            $table->string('estado');
            $table->timestamps();
        });

        Schema::table('config_bloqueios', function (Blueprint $table) {
            $table->foreign('id_bloqueio')->references('id')->on('bloqueio_epocas')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_bloqueios');
    }
}
