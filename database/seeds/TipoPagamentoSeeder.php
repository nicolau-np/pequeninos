<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPagamentoSeeder extends Seeder
{
    static $tipo_pagamentos = [
        [
            'tipo' => "Comparticipação de Mensal",
            'multa' => "nao",
            'dia_cobranca_multa'=>null,
        ],
        [
            'tipo' => "Matricula & Reconfirmação",
            'multa' => "nao",
            'dia_cobranca_multa'=>null,
        ],
        [
            'tipo' => "Comparticipação de Pais",
            'multa' => "nao",
            'dia_cobranca_multa'=>null,
        ],
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