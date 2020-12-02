<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnsinoSeeder extends Seeder
{
    static $ensinos = [
        ['ensino'=>'Primário (ini . 6)'],
        ['ensino'=>'Primário & I Cíclo (7 . 9)'],
        ['ensino'=>'Formação Técnico (7 . 9)'],
        ['ensino'=>'Formação Técnico Profissional (10 . 12)'],
        ['ensino'=>'Secundário & II Cíclo (10 .12)'],
        ['ensino'=>'Formação de Professores (10 . 13)'],
        ['ensino'=>'Superior'],
        
    ];
    
    public function run()
    {
        foreach(Self::$ensinos as $ensino){
            DB::table('ensinos')->insert(
                $ensino
            );
        }
    }
}