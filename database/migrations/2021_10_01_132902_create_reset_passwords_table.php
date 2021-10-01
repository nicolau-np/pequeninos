<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResetPasswordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reset_passwords', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_user')->unsigned()->index();
            $table->text('hash_code')->nullable();
            $table->string('verify_code');
            $table->string('estado');
            $table->timestamps();
        });

        Schema::table('reset_passwords', function (Blueprint $table){
            $table->foreign('id_user')->references('id')->on('usuarios')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reset_passwords');
    }
}