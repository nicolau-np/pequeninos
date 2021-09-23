<?php

namespace App\Imports;

use App\Estudante;
use App\HistoricEstudante;
use App\Pessoa;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PessoaImport implements
    ToCollection,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    WithChunkReading,
    ShouldQueue
{
    use Importable, SkipsErrors;

    public function collection(Collection $rows)
    {
        $data['pessoa'] = [
            'nome' => null,
            'genero' => null,
            'data_nascimento' => "1996-08-29",
            'id_municipio' => 1,
        ];

        $data['estudante'] = [
            'id_pessoa' => null,
            'id_turma' => null,
            'id_encarregado' => 1,
            'estado' => "on",
            'ano_lectivo' => null,
        ];

        $data['historico'] = [
            'id_estudante' => null,
            'id_turma' => null,
            'estado' => "on",
            'observacao_final' => null,
            'ano_lectivo' => null,
        ];
        foreach ($rows as $row) {

            if (!Pessoa::where(['nome' => $row['nome']])->first()) {
                $data['pessoa']['nome'] = $row['nome'];
                $data['pessoa']['genero'] = $row['genero'];
                $pessoa = Pessoa::create($data['pessoa']);

                $data['estudante']['id_pessoa'] = $pessoa->id;
                $data['estudante']['ano_lectivo'] = $row['ano_lectivo'];
                $data['estudante']['id_turma'] = $row['id_turma'];
                $estudante = Estudante::create($data['estudante']);

                $data['historico']['id_estudante'] = $estudante->id;
                $data['historico']['id_turma'] = $row['id_turma'];
                $data['historico']['ano_lectivo'] = $row['ano_lectivo'];
                $historico = HistoricEstudante::create($data['historico']);
            }
        }
    }

    public function rules(): array
    {
        return [];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}