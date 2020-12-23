<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EncarregadoSeeder extends Seeder
{
   static $encarregados = [
       [
        'id_pessoa'=>4,
        'estado'=>"on",
       ]
   ];
    public function run()
    {
        foreach(Self::$encarregados as $encarregado){
            DB::table('encarregados')->insert(
                $encarregado
            );
        }
    }
}