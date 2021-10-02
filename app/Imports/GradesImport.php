<?php

namespace App\Imports;

use App\Grade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class GradesImport implements
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
            'id_curso' => null,
            'id_classe' => null,
            'id_disciplina' => null,
            'tipo' => null,
        ];

        foreach ($rows as $row) {
            $data['id_curso'] = $row['id_curso'];
            $data['id_classe'] = $row['id_classe'];
            $data['id_disciplina'] = $row['id_disciplina'];
            $data['tipo'] = $row['tipo'];

            if (!Grade::where($data)->first()) {
                $grade = Grade::create($data);
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