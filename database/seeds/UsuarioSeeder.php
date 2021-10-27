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
                'username' => "sige.master",//master director geral
                'password' => Hash::make("escola001"),
                'estado' => "on",
                'nivel_acesso' => "master",
                'isVerified'=>1,
            ],
            [
                'id_pessoa' => 2,
                'username' => "sige.admin",//admin pedagogico
                'password' => Hash::make("escola001"),
                'estado' => "on",
                'nivel_acesso' => "admin",
                'isVerified'=>1,
            ],[
                'id_pessoa' => 3,
                'username' => "sige.user",//user financas
                'password' => Hash::make("escola001"),
                'estado' => "on",
                'nivel_acesso' => "user",
                'isVerified'=>1,
            ],[
                'id_pessoa' => 4,
                'username' => "sige.super",//user love
                'password' => Hash::make("escola001"),
                'estado' => "on",
                'nivel_acesso' => "super",
                'isVerified'=>1,
            ],


        ]);
    }
}