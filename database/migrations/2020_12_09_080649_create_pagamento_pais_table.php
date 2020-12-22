<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentoPaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamento_pais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_tipo_pagamento')->unsigned()->index();
            $table->bigInteger('id_usuario')->unsigned()->index();
            $table->bigInteger('id_encarregado')->unsigned()->index();
            $table->string('epoca');
            $table->decimal('preco', 14,2);
            $table->date('data_pagamento');
            $table->bigInteger('fatura');
            $table->bigInteger('mes_pagamento');
            $table->string('ano_lectivo');
            $table->timestamps();
        });

        Schema::table('pagamento_pais', function (Blueprint $table) {
            $table->foreign('id_tipo_pagamento')->references('id')->on('tipo_pagamentos')->onUpdate('cascade');
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onUpdate('cascade');
            $table->foreign('id_encarregado')->references('id')->on('encarregados')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamento_pais');
    }
}