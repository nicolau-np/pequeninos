<?php

namespace App\Imports;

use App\Estudante;
use App\HistoricEstudante;
use App\Pessoa;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EstudanteImport implements ToCollection, 
WithBatchInserts, WithHeadingRow, SkipsOnError, 
WithValidation, WithChunkReading, ShouldQueue
{
   use Importable, SkipsErrors, SkipsFailures;
    

   
   public function collection(Collection $rows)
   {
      foreach($rows as $row){
          $pessoa = Pessoa::create([
            'id_municipio'=>1,
            'nome'=>$row['nome'],
            'data_nascimento'=>"2001-01-01",
            'genero'=>$row['genero'],
          ]);

          if($pessoa){
              $estudante = Estudante::create([
                'id_turma'=>$row['id_turma'],
                'id_pessoa'=>$pessoa->id,
                'id_encarregado'=>$row['id_encarregado'],
                'estado'=>"on",
                'ano_lectivo'=>$row['ano_lectivo'],   
              ]);

              if($estudante){
                  HistoricEstudante::create([
                    'id_estudante'=>$estudante->id,
                    'id_turma'=>$row['id_turma'],
                    'estado'=>"on",
                    'ano_lectivo'=>$row['ano_lectivo'],
                  ]);
              }
          }
      }
   }

   public function rules(): array
   {
       return [
           
       ];
   }

   public function batchSize(): int
   {
       return 1000;
   }

   public function chunkSize(): int
   {
       return 1000;
   }
}