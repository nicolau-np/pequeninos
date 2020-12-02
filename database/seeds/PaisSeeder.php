<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaisSeeder extends Seeder
{
    static $paises = [
        [
            'pais' => "Angola",
            'indicativo' => "+244",
            'capital' => "Luanda",
            'img_bandeira' => "https://upload.wikimedia.org/wikipedia/commons/9/9d/Flag_of_Angola.svg"
        ],
        [
            'pais' => "Portugal",
            'indicativo' => "+351",
            'capital' => "Lisboa",
            'img_bandeira' => "https://i.pinimg.com/originals/3f/80/51/3f805177a19f8e0b88790710abf75a61.jpg"
        ],
    ];

    public function run()
    {
        foreach (Self::$paises as $pais) {
            DB::table('pais')->insert(
                $pais
            );
        }
    }
}