<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSalaSeeder extends Seeder
{
    static $tipo_salas = [
        ['tipo'=>"Normal"],
        ['tipo'=>"Anexa"],
        ['tipo'=>"Salão"],
        ['tipo'=>"Laboratório"],
    ];
    public function run()
    {
        foreach(Self::$tipo_salas as $tipo_sala){
            DB::table('tipo_salas')->insert(
                $tipo_sala
            );
        }
    }
}