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

class EstudanteImport implements
    ToCollection,
    WithBatchInserts,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    WithChunkReading,
    ShouldQueue
{
    use Importable, SkipsErrors, SkipsFailures;



    public function collection(Collection $rows)
    {

        $data['pessoa'] = [
            'id_municipio' => 1,
            'nome' => null,
            'data_nascimento' => "2001-01-01",
            'genero' => null,
        ];

        $data['estudante'] = [
            'id_turma' => null,
            'id_pessoa' => null,
            'id_encarregado' => 1,
            'estado' => "on",
            'ano_lectivo' => null,
        ];

        $data['historico'] = [
            'id_estudante' => null,
            'id_turma' => null,
            'estado' => "on",
            'ano_lectivo' => null,
        ];

        foreach ($rows as $row) {
            /*actualizando valores*/
            $data['pessoa']['nome'] = $row['nome'];
            $data['pessoa']['genero'] = $row['genero'];
            /*fim*/

            /*cadastrando*/
            $pessoa = Pessoa::create($data['pessoa']);
            if ($pessoa) {
                /*actualizando valores*/
                $data['estudante']['id_turma'] = $row['id_turma'];
                $data['estudante']['id_pessoa'] = $pessoa->id;
                $data['estudante'] = $row['ano_lectivo'];
                /*fim*/
                $estudante = Estudante::create($data['estudante']);

                if ($estudante) {
                    /*actualizando valores*/
                    $data['historico']['id_estudante'] = $estudante->id;
                    $data['historico']['ano_lectivo'] = $row['ano_lectivo'];
                    $data['historico']['id_turma'] = $row['id_turma'];
                    /*fim*/
                    HistoricEstudante::create($data['historico']);
                }
            }
            /*fim */
        }
    }

    public function rules(): array
    {
        return [];
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