<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PessoaSeeder extends Seeder
{
    static $pessoas = [
        [
            'id_municipio' => 1,
            'nome' => "Sige Master",
            'data_nascimento' => "1996-08-29",
            'genero' => "M",
            'estado_civil' => "solteiro"
        ],
        [
            'id_municipio' => 1,
            'nome' => "Sige Admin",
            'data_nascimento' => "1996-08-29",
            'genero' => "M",
            'estado_civil' => "solteiro"
        ],[
            'id_municipio' => 1,
            'nome' => "Sige User",
            'data_nascimento' => "1996-08-29",
            'genero' => "M",
            'estado_civil' => "solteiro"
        ],

        [
            'id_municipio' => 4,
            'nome' => "Encarregado Exemplo",
            'data_nascimento' => "1990-01-01",
            'genero' => "Masculino",
            'estado_civil' => "solteiro"
        ],

    ];

    public function run()
    {
        foreach (Self::$pessoas as $pessoa) {
            DB::table('pessoas')->insert(
                $pessoa
            );
        }
    }
}