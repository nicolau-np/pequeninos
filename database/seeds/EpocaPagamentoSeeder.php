<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EpocaPagamentoSeeder extends Seeder
{
   static $epoca_pagamentos = [
       //trimestral
       [
           'id_forma_pagamento'=>1,
           'epoca'=>"1 Trimestre",
           'numero'=>null,
       ],
       [
        'id_forma_pagamento'=>1,
        'epoca'=>"2 Trimestre",
        'numero'=>null,
       ],
       [
        'id_forma_pagamento'=>1,
        'epoca'=>"3 Trimestre",
        'numero'=>null,
       ],
       //mensal

       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Setembro",
        'numero'=>9,
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Outubro",
        'numero'=>10,
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Novembro",
        'numero'=>11,
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Dezembro",
        'numero'=>12,
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Janeiro",
        'numero'=>1,
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Fevereiro",
        'numero'=>2,
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Março",
        'numero'=>3,
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Abril",
        'numero'=>4,
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Maio",
        'numero'=>5,
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Junho",
        'numero'=>6,
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Julho",
        'numero'=>7,
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Agosto",
        'numero'=>8,
       ],
       //anual
       [
        'id_forma_pagamento'=>3,
        'epoca'=>"1ª Vez",
        'numero'=>null,
       ],
       //momental
       [
        'id_forma_pagamento'=>4,
        'epoca'=>"Pagar",
        'numero'=>null,
       ],
   ];
    public function run()
    {
        foreach(Self::$epoca_pagamentos as $epoca_pagamento){
            DB::table('epoca_pagamentos')->insert(
              $epoca_pagamento
            );
        }
    }
}