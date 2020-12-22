<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPagamentoSeeder extends Seeder
{
    static $tipo_pagamentos = [
        ['tipo' => "Propina"],
        ['tipo' => "Matricula & Reconfirmação"],
        ['tipo' => "Comparticipação de Pais"],
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