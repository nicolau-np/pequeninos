<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finals', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigInteger('id_estudante')->unsigned()->index();
            $table->bigInteger('id_disciplina')->unsigned()->index();
            $table->decimal('mfd', 4, 2)->nullable();
            $table->date('mfd_data')->nullable();
            $table->decimal('mf', 4, 2)->nullable();
            $table->string('ano_lectivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finals');
    }
}