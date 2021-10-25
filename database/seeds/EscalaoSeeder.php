<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EscalaoSeeder extends Seeder
{
    static $escalaos = [
        [
            'escalao' => "PEPD 6º E"
        ],
        [
            'escalao' => "PIICESD 6º E"
        ],
        [
            'escalao' => "PEPAUX 6º E"
        ],
        [
            'escalao' => "PICESD 6º E"
        ],
    ];
    public function run()
    {
        foreach (Self::$escalaos as $escalao) {
            DB::table('escalaos')->insert(
                $escalao
            );
        }
    }
}