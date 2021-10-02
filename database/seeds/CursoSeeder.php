<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursoSeeder extends Seeder
{
    static $cursos = [

        [
            'id_ensino'=>1,
            'curso'=>'Fundamental',
        ],
        [
            'id_ensino'=>2,
            'curso'=>'Geral',
        ],
        [
            'id_ensino'=>3,
            'curso'=>'Geral(EJA)',
        ]
    ];

    public function run()
    {
        foreach(Self::$cursos as $curso){
            DB::table('cursos')->insert(
                $curso
            );
        }
    }
}