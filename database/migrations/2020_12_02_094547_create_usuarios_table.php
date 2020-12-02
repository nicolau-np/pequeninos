<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_pessoa')->unsigned()->index();
            $table->string('username')->unique();
            $table->text('password');
            $table->string('estado');
            $table->string('nivel_acesso');
            $table->string('provider')->nullable();
            $table->text('provider_id')->nullable();
            $table->date('email_verified_at')->nullable();
            $table->text('code_verification')->nullable();
            $table->bigInteger('isVerified')->default(0)->nullable();
            $table->timestamps();
        });

        Schema::table('usuarios', function (Blueprint $table) {
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
        Schema::dropIfExists('usuarios');
    }
}