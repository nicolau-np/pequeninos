<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormaPagamentoSeeder extends Seeder
{
    static $forma_pagamentos = [
        ['forma_pagamento' => "Trimestral"],
        ['forma_pagamento' => "Mensal"],
        ['forma_pagamento' => "Anual"],
    ];
    public function run()
    {
        foreach(Self::$forma_pagamentos as $forma_pagamento){
            DB::table('forma_pagamentos')->insert(
                $forma_pagamento
            );
        }
    }
}