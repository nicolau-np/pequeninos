<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_tipo_pagamento')->unsigned()->index();
            $table->bigInteger('id_usuario')->unsigned()->index();
            $table->bigInteger('id_estudante')->unsigned()->index();
            $table->string('epoca');
            $table->decimal('preco', 14,2);
            $table->date('data_pagamento');
            $table->bigInteger('fatura');
            $table->bigInteger('mes_pagamento');
            $table->text('descricao')->nullable();
            $table->string('ano_lectivo');
            $table->timestamps();
        });

        Schema::table('pagamentos', function (Blueprint $table) {
            $table->foreign('id_tipo_pagamento')->references('id')->on('tipo_pagamentos')->onUpdate('cascade');
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onUpdate('cascade');
            $table->foreign('id_estudante')->references('id')->on('estudantes')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamentos');
    }
}