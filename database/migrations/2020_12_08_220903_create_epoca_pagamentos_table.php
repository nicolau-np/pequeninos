<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpocaPagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epoca_pagamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_forma_pagamento')->unsigned()->index();
            $table->string('epoca');
            $table->timestamps();
        });

        Schema::table('epoca_pagamentos', function (Blueprint $table) {
            $table->foreign('id_forma_pagamento')->references('id')->on('forma_pagamentos')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epoca_pagamentos');
    }
}