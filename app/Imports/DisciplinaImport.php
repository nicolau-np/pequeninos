<?php

namespace App\Imports;

use App\Disciplina;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class DisciplinaImport implements ToCollection,
WithHeadingRow,
SkipsOnError,
WithValidation,
WithChunkReading,
ShouldQueue
{
    use Importable, SkipsErrors;

    public function collection(Collection $rows)
    {
        $password = Hash::make('olamundo2015');
        $data['person'] = [
            'nome' => null,
            'genero' => null,
            'data_nascimento' => date('Y-m-d'),
            'id_municipio' => 1,
        ];

        $data['funcionario'] = [
            'id_pessoa' => null,
            'id_cargo' => 1,
            'id_escalao' => 1,
            'estado' => "on",
        ];

        $data['user'] = [
            'id_pessoa' => null,
            'username' => null,
            'password' => $password,
            'estado' => "on",
            'nivel_acesso' => "professor",
        ];

        foreach ($rows as $row) {
            if (!Pessoa::where(['nome' => $row['nome']])->first()) {

                $data['person']['nome'] = $row['nome'];
                $data['person']['genero'] = $row['genero'];
                $pessoa = Pessoa::create($data['person']);

                $data['funcionario']['id_pessoa'] = $pessoa->id;
                $funcionario = Funcionario::create($data['funcionario']);

                $string_nome = explode(" ", $row['nome']);
                $primeiro_nome = $string_nome[0];
                $ultimo_nome = end($string_nome);
                $nome_completo = strtolower($primeiro_nome . "." . $ultimo_nome) . "" . $pessoa->id;
                $nome_converte = $this->converter_acentos($nome_completo);
                $data['user']['username'] = $nome_converte;
                $data['user']['id_pessoa'] = $pessoa->id;

                $user = User::create($data['user']);
            }
        }
    }

    public function converter_acentos($string)
    {
        return preg_replace(
            array(
                "/(á|â|ã|à)/", "/(Á|Â|Ã|À)/",
                "/(é|è|ê)/", "/(É|È|Ê)/", "/(í|ì|î)/", "/(Í|Ì|Î)/",
                "/(ó|ò|õ|ô)/", "/(Ó|Ò|Õ|Ô)/", "/(ú|ù|û)/", "/(Ú|Ù|Û)/",
                "/(ñ)/", "/(Ñ)/", "/(ç)/", "/(Ç)/"
            ),
            explode(" ", "a A e E i I o O u U n N c C"),
            $string);
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