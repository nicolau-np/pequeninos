<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run()
    {

        DB::table('usuarios')->insert([
            [
                'id_pessoa' => 1,
                'username' => "sige.master",
                'password' => Hash::make("olamundo2015"),
                'estado' => "on",
                'nivel_acesso' => "master",
                'isVerified'=>1,
            ],
            [
                'id_pessoa' => 2,
                'username' => "sige.admin",
                'password' => Hash::make("olamundo2015"),
                'estado' => "on",
                'nivel_acesso' => "admin",
                'isVerified'=>1,
            ],[
                'id_pessoa' => 3,
                'username' => "sige.user",
                'password' => Hash::make("olamundo2015"),
                'estado' => "on",
                'nivel_acesso' => "admin",
                'isVerified'=>1,
            ],


        ]);
    }
}