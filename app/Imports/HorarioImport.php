<?php

namespace App\Imports;

use App\Horario;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class HorarioImport implements
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

        $data = [
            'id_funcionario' => null,
            'id_turma' => null,
            'id_disciplina' => null,
            'estado' => null,
            'ano_lectivo' => null,
        ];

        foreach ($rows as $row) {
            $data['id_funcionario'] = $row['id_funcionario'];
            $data['id_turma'] = $row['id_turma'];
            $data['id_disciplina'] = $row['id_disciplina'];
            $data['estado'] = $row['estado'];
            $data['ano_lectivo'] = $row['ano_lectivo'];
            if (!Horario::where($data)->first()) {

                $horario = Horario::create($data);
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