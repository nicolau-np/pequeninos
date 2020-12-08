<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EpocaPagamentoSeeder extends Seeder
{
   static $epoca_pagamentos = [
       //trimestral
       [
           'id_forma_pagamento'=>1,
           'epoca'=>"1 Trimestre"
       ],
       [
        'id_forma_pagamento'=>1,
        'epoca'=>"2 Trimestre"
       ],
       [
        'id_forma_pagamento'=>1,
        'epoca'=>"3 Trimestre"
       ],
       //mensal
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Janeiro"
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Fevereiro"
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Março"
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Abril"
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Maio"
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Junho"
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Julho"
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Agosto"
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Setembro"
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Outubro"
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Novembro"
       ],
       [
        'id_forma_pagamento'=>2,
        'epoca'=>"Dezembro"
       ],
       //anual
       [
        'id_forma_pagamento'=>3,
        'epoca'=>"1ª Vez"
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