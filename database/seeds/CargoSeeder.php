<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoSeeder extends Seeder
{
    static $cargos = [
        ['cargo'=>'Professor Efectivo'],
        ['cargo'=>'Professor Colaborador'],
        ['cargo'=>'Professor Eventual'],
        ['cargo'=>'Chefe Secretaria'],
        ['cargo'=>'Director'],
        ['cargo'=>'Sub-Director'],
    ];
    
    public function run()
    {
        foreach(Self::$cargos as $cargo){
            DB::table('cargos')->insert(
              $cargo  
            );
        }
    }
}