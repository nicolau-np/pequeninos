<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasseSeeder extends Seeder
{
    
    static $classes = [
        //ensino 1
        [
            'id_ensino'=>1,
            'classe'=>'Iniciação',
        ],[
            'id_ensino'=>1,
            'classe'=>'1ª classe',
        ],[
            'id_ensino'=>1,
            'classe'=>'2ª classe',
        ],[
            'id_ensino'=>1,
            'classe'=>'3ª classe',
        ],[
            'id_ensino'=>1,
            'classe'=>'4ª classe',
        ],[
            'id_ensino'=>1,
            'classe'=>'5ª classe',
        ],[
            'id_ensino'=>1,
            'classe'=>'6ª classe',
        ],
        //ensino 2
        [
            'id_ensino'=>2,
            'classe'=>'7ª classe',
        ],[
            'id_ensino'=>2,
            'classe'=>'8ª classe',
        ],[
            'id_ensino'=>2,
            'classe'=>'9ª classe',
        ],
        //ensino 3
        [
            'id_ensino'=>3,
            'classe'=>'7ª classe',
        ],[
            'id_ensino'=>3,
            'classe'=>'8ª classe',
        ],[
            'id_ensino'=>3,
            'classe'=>'9ª classe',
        ],
        //ensino 4
        [
            'id_ensino'=>4,
            'classe'=>'10ª classe',
        ],[
            'id_ensino'=>4,
            'classe'=>'11ª classe',
        ],[
            'id_ensino'=>4,
            'classe'=>'12ª classe',
        ],
        //ensino 5
        [
            'id_ensino'=>5,
            'classe'=>'10ª classe',
        ],[
            'id_ensino'=>5,
            'classe'=>'11ª classe',
        ],[
            'id_ensino'=>5,
            'classe'=>'12ª classe',
        ],
        //ensino 6
        [
            'id_ensino'=>6,
            'classe'=>'10ª classe',
        ],[
            'id_ensino'=>6,
            'classe'=>'11ª classe',
        ],[
            'id_ensino'=>6,
            'classe'=>'12ª classe',
        ],[
            'id_ensino'=>6,
            'classe'=>'13ª classe',
        ],
         //ensino 7
         [
            'id_ensino'=>7,
            'classe'=>'1 ano',
        ],[
            'id_ensino'=>7,
            'classe'=>'2 ano',
        ],[
            'id_ensino'=>7,
            'classe'=>'3 ano',
        ],[
            'id_ensino'=>7,
            'classe'=>'4 ano',
        ],[
            'id_ensino'=>7,
            'classe'=>'5 ano',
        ],
    ];
    
    public function run()
    {
        foreach(Self::$classes as $classe){
            DB::table('classes')->insert(
              $classe  
            );
        }
    }
}