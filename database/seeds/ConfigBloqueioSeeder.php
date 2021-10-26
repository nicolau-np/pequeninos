<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigBloqueioSeeder extends Seeder
{
    static $config_bloqueios = [
        //epoca 1
        [
            'id_bloqueio' => 1,
            'tipo' => "av1",
            'estado' => "off",
        ], [
            'id_bloqueio' => 1,
            'tipo' => "av2",
            'estado' => "off",
        ], [
            'id_bloqueio' => 1,
            'tipo' => "av3",
            'estado' => "off",
        ], [
            'id_bloqueio' => 1,
            'tipo' => "p1",
            'estado' => "off",
        ], [
            'id_bloqueio' => 1,
            'tipo' => "p2",
            'estado' => "off",
        ],
        //epoca 2
        [
            'id_bloqueio' => 2,
            'tipo' => "av1",
            'estado' => "off",
        ], [
            'id_bloqueio' => 2,
            'tipo' => "av2",
            'estado' => "off",
        ], [
            'id_bloqueio' => 2,
            'tipo' => "av3",
            'estado' => "off",
        ], [
            'id_bloqueio' => 2,
            'tipo' => "p1",
            'estado' => "off",
        ], [
            'id_bloqueio' => 2,
            'tipo' => "p2",
            'estado' => "off",
        ],
        //epoca 3
        [
            'id_bloqueio' => 3,
            'tipo' => "av1",
            'estado' => "off",
        ], [
            'id_bloqueio' => 3,
            'tipo' => "av2",
            'estado' => "off",
        ], [
            'id_bloqueio' => 3,
            'tipo' => "av3",
            'estado' => "off",
        ], [
            'id_bloqueio' => 3,
            'tipo' => "p1",
            'estado' => "off",
        ], [
            'id_bloqueio' => 3,
            'tipo' => "p2",
            'estado' => "off",
        ],
        //epoca 4
        [
            'id_bloqueio' => 4,
            'tipo' => "pg",
            'estado' => "off",
        ],
        //epoca 5
        [
            'id_bloqueio' => 5,
            'tipo' => "rec",
            'estado' => "off",
        ],
    ];


    public function run()
    {
        foreach (Self::$config_bloqueios as $bloqueios) {
            DB::table('config_bloqueios')->insert(
                $bloqueios
            );
        }
    }
}
