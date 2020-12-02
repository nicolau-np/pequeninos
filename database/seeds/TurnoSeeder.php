<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TurnoSeeder extends Seeder
{
    static $turnos = [
        ['turno'=>'Manha'],
        ['turno'=>'Tarde'],
        ['turno'=>'Noite'],
    ];
    
    public function run()
    {
        foreach(Self::$turnos as $turno){
            DB::table('turnos')->insert(
                $turno
            );
        }
    }
}