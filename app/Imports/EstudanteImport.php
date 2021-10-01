<?php

namespace App\Imports;

use App\Estudante;
use App\HistoricEstudante;
use App\Pessoa;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EstudanteImport implements
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
            'data_nascimento' => null,
            'id_municipio' => 1,
        ];

        $data['estudante'] = [
            'id_pessoa' => null,
            'id_turma' => Session::get('id_turmaIMP'),
            'numero'=>null,
            'id_encarregado' => 1,
            'estado' => "on",
            'ano_lectivo' => Session::get('ano_lectivoIMP'),
        ];

        $data['historico'] = [
            'id_estudante' => null,
            'id_turma' => Session::get('id_turmaIMP'),
            'numero'=>null,
            'estado' => "on",
            'observacao_final' => null,
            'ano_lectivo' => Session::get('ano_lectivoIMP'),
        ];
        foreach ($rows as $row) {
            //convertendo data
            $data_nascimento = date('Y-m-d', strtotime($this->transformData(intval($row['data_nascimento']))));

            if (!Pessoa::where(['nome' => $row['nome'], 'data_nascimento'=>$data_nascimento])->first()) {
                $data['pessoa']['nome'] = $row['nome'];
                $data['pessoa']['genero'] = $row['genero'];

                $data['pessoa']['data_nascimento'] = $data_nascimento;
                $pessoa = Pessoa::create($data['pessoa']);

                $data['estudante']['numero'] = $row['n'];
                $data['estudante']['id_pessoa'] = $pessoa->id;
                $estudante = Estudante::create($data['estudante']);

                $data['historico']['id_estudante'] = $estudante->id;
                $data['historico']['numero'] = $row['n'];
                $historico = HistoricEstudante::create($data['historico']);
            }

        }
    }

    public function transformData($value, $format="Y-m-d"){
        try{
           return  \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        }catch(\ErrorException $e){
            return \Carbon\Carbon::createFromFormat($format, $value);
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
