<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipioSeeder extends Seeder
{
    static $municipios = [
        //Namibe => 1
        [
            'id_provincia' => 1,
            'municipio' => "Moçamedes"
        ],
        [
            'id_provincia' => 1,
            'municipio' => "Tômbua"
        ],
        [
            'id_provincia' => 1,
            'municipio' => "Virei"
        ],
        [
            'id_provincia' => 1,
            'municipio' => "Bibala"
        ],
        [
            'id_provincia' => 1,
            'municipio' => "Camucuio"
        ],
        [
            'id_provincia' => 1,
            'municipio' => "Lucira"
        ],
        //Benguela => 2
        [
            'id_provincia' => 2,
            'municipio' => "Balombo"
        ],
        [
            'id_provincia' => 2,
            'municipio' => "Baía Farta"
        ],
        [
            'id_provincia' => 2,
            'municipio' => "Benguela"
        ],
        [
            'id_provincia' => 2,
            'municipio' => "Bocoio"
        ],
        [
            'id_provincia' => 2,
            'municipio' => "Caimbambo"
        ],
        [
            'id_provincia' => 2,
            'municipio' => "Catumbela"
        ],
        [
            'id_provincia' => 2,
            'municipio' => "Chongorói"
        ],
        [
            'id_provincia' => 2,
            'municipio' => "Cubal"
        ],
        [
            'id_provincia' => 2,
            'municipio' => "Ganda"
        ],
        [
            'id_provincia' => 2,
            'municipio' => "Lobito"
        ],
    ];

    public function run()
    {
        foreach (Self::$municipios as $municipio) {
            DB::table('municipios')->insert(
                $municipio
            );
        }
    }
}