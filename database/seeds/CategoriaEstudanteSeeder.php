<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaEstudanteSeeder extends Seeder
{
    static $categorias = [
        [
            'categoria' => "ALUNOS BOLSEIROS DA COMUNIDADE CARENTE",
            'sigla' => "BCC",
            'estado' => "on",
        ], [
            'categoria' => "ALUNOS ISENTOS A 100% FILHOS DOS FUNCIONARIOS",
            'sigla' => "IFF 100%",
            'estado' => "on",
        ], [
            'categoria' => "ALUNOS ISENTOS A 100% (QUADRO DE HONRA)",
            'sigla' => "IQH",
            'estado' => "on",
        ], [
            'categoria' => "ALUNOS ISENTOS A 50% FILHOS DOS FUNCIONARIOS",
            'sigla' => "IFF 50%",
            'estado' => "on",
        ], [
            'categoria' => "CRIANÇAS CONTRIBUNTES DO PROG DE FORT FAMILIAR",
            'sigla' => "CPFF",
            'estado' => "on",
        ], [
            'categoria' => "CRIANÇAS CONTRIBUNTES  DA ALDEIA SOS",
            'sigla' => "CA SOS",
            'estado' => "on",
        ], [
            'categoria' => "ALUNOS CONTRIBUNTES DA COMUNIDADE",
            'sigla' => "CC",
            'estado' => "on",
        ]
    ];

    public function run()
    {
        foreach (Self::$categorias as $categoria) {
            DB::table('categoria_estudantes')->insert($categoria);
        }
    }
}
