<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinciaSeeder extends Seeder
{
    static $provincias = [
        [
            'id_pais' => 1,
            'provincia' => "Namibe",
            'cidade_cede' => "Moçamedes"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Benguela",
            'cidade_cede' => "Benguela"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Huíla",
            'cidade_cede' => "Lubango"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Cabinda",
            'cidade_cede' => "Cabinda"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Malanje",
            'cidade_cede' => "Malanje"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Lunda Sul",
            'cidade_cede' => "Saurimo"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Lunda Norte",
            'cidade_cede' => "Dundo"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Cuanza Sul",
            'cidade_cede' => "Sumbe"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Cuanza Norte",
            'cidade_cede' => "Ndalatando"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Uíge",
            'cidade_cede' => "Uíge"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Zaire",
            'cidade_cede' => "MBanza Congo"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Luanda",
            'cidade_cede' => "Luanda"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Huambo",
            'cidade_cede' => "Huambo"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Bié",
            'cidade_cede' => "Cuito"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Cunene",
            'cidade_cede' => "Cunene"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Cuando Cubango",
            'cidade_cede' => "Menongue"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Moxico",
            'cidade_cede' => "Luena"
        ],
        [
            'id_pais' => 1,
            'provincia' => "Bengo",
            'cidade_cede' => "Caxito"
        ],

    ];

    public function run()
    {
        foreach (Self::$provincias as $provincia) {
            DB::table('provincias')->insert(
                $provincia
            );
        }
    }
}