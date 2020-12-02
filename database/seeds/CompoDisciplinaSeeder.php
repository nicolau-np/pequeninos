<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompoDisciplinaSeeder extends Seeder
{
    static $compo_disciplinas = [
        ['componente'=>"Social"],
        ['componente'=>"Científica"]
    ];
    
    public function run()
    {
        foreach(Self::$compo_disciplinas as $compo_disciplina){
            DB::table('compo_disciplinas')->insert(
                $compo_disciplina
            );
        }
    }
}