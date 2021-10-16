<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPagamentoSeeder extends Seeder
{
    static $tipo_pagamentos = [
        ['tipo' => "Comparticipação de Mensal", 'multa' => "sim"],
        ['tipo' => "Matricula & Reconfirmação", 'multa' => "nao"],
        ['tipo' => "Comparticipação de Pais", 'multa' => "nao"],
    ];

    public function run()
    {
        foreach (Self::$tipo_pagamentos as $tipo_pagamento) {
            DB::table('tipo_pagamentos')->insert(
                $tipo_pagamento
            );
        }
    }
}