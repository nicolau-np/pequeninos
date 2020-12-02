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
                'email' => "nicolau.pungue@gmail.com",
                'password' => Hash::make("olamundo2015"),
                'estado' => "on",
                'nivel_acesso' => "admin",
                'isVerified'=>1,
            ],
            [
                'id_pessoa' => 2,
                'email' => "hebraim.zua@gmail.com",
                'password' => Hash::make("olaola"),
                'estado' => "on",
                'nivel_acesso' => "user",
                'isVerified'=>1,
            ],
            [
                'id_pessoa' => 3,
                'email' => "fernanda.rosa@gmail.com",
                'password' => Hash::make("babaca"),
                'estado' => "on",
                'nivel_acesso' => "user",
                'isVerified'=>1,
            ],
        ]);
    }
}