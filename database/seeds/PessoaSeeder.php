<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PessoaSeeder extends Seeder
{
    static $pessoas = [
        [
          'id_municipio'=>1,
          'nome'=>"Nicolau Pungue",
          'data_nascimento'=>"1996-08-29",
          'genero'=>"Masculino",
          'estado_civil'=>"solteiro" 
        ],
        [
            'id_municipio'=>2,
            'nome'=>"Hebraim Zua",
            'data_nascimento'=>"1997-03-10",
            'genero'=>"Masculino",
            'estado_civil'=>"solteiro" 
          ],
          [
            'id_municipio'=>10,
            'nome'=>"Fernada Rosa",
            'data_nascimento'=>"1998-02-05",
            'genero'=>"Femenino",
            'estado_civil'=>"solteira" 
          ],
          
    ];
        
        public function run()
        {
           foreach(Self::$pessoas as $pessoa){
               DB::table('pessoas')->insert(
                   $pessoa
               );
           }
        }
}