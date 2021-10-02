<?php

namespace App\Imports;

use App\Turma;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TurmaImport implements
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
            'id_curso'=>null,
            'id_classe'=>null,
            'id_turno'=>null,
            'turma'=>null,
            'sala'=>null,
        ];

        foreach ($rows as $row) {
            if (!Turma::where(['turma' => $row['turma']])->first()) {
                $data['id_curso'] = $row['id_curso'];
                $data['id_classe'] = $row['id_classe'];
                $data['id_turno'] = $row['id_turno'];
                $data['turma'] = $row['turma'];
                $data['sala'] = $row['sala'];

                $turma = Turma::create($data);
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