<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnoLectivoSeeder extends Seeder
{
   static $ano_lectivos = [
     ['ano_lectivo'=>"2020-2021"],
     ['ano_lectivo'=>"2021-2022"],
   ];
    public function run()
    {
        foreach(Self::$ano_lectivos as $ano_lectivo){
            DB::table('ano_lectivos')->insert(
              $ano_lectivo
            );
        }
    }
}