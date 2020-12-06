<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EscalaoSeeder extends Seeder
{
    static $escalaos = [
        ['escalao'=>"EPX I"],
        ['escalao'=>"EPX II"],
        ['escalao'=>"ESP I"],
    ];
    public function run()
    {
        foreach(Self::$escalaos as $escalao){
            DB::table('escalaos')->insert(
                $escalao
            );
        }
    }
}