<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloqueioEpocaSeeder extends Seeder
{

    static $bloqueio_epocas = [
        [
            'epoca'=>1,
            'estado'=>"off"
        ],[
            'epoca'=>2,
            'estado'=>"off"
        ],[
            'epoca'=>3,
            'estado'=>"off"
        ],[
            'epoca'=>4,
            'estado'=>"on"
        ]
    ];

    public function run()
    {
        foreach(Self::$bloqueio_epocas as $bloqueio_epoca){
            DB::table('bloqueio_epocas')->insert(
                $bloqueio_epoca
            );
        }
    }
}