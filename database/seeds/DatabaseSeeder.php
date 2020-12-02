<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call([
           PaisSeeder::class,
           ProvinciaSeeder::class,
           MunicipioSeeder::class,
           PessoaSeeder::class,
           UsuarioSeeder::class,
           CargoSeeder::class,
           EscalaoSeeder::class,
           EnsinoSeeder::class,
           TurnoSeeder::class,
           ClasseSeeder::class,
           FuncionarioSeeder::class,
           TipoPagamentoSeeder::class,
       ]);
    }
}