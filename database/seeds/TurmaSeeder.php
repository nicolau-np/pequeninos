<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TurmaSeeder extends Seeder
{
    static $turmas = [
        [
            'id_curso'=>1,
            'id_classe'=>2,
            'id_turno'=>1,
            'turma'=>"Nenhuma",
        ],
    ];
    public function run()
    {
        foreach(Self::$turmas as $turma){
            DB::table('turmas')->insert(
                $turma
            );
        }
    }
}