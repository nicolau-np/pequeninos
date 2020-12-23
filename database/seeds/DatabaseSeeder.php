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
           EncarregadoSeeder::class,
           CargoSeeder::class,
           EscalaoSeeder::class,
           EnsinoSeeder::class,
           TurnoSeeder::class,
           ClasseSeeder::class,
           CursoSeeder::class,
           TurmaSeeder::class,
           FuncionarioSeeder::class,
           TipoPagamentoSeeder::class,
           CompoDisciplinaSeeder::class,
           AnoLectivoSeeder::class,
           TipoSalaSeeder::class,
           FormaPagamentoSeeder::class,
           EpocaPagamentoSeeder::class,
       ]);
    }
}