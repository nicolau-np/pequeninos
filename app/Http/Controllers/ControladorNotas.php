<?php

namespace App\Http\Controllers;

use App\Trimestral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ControladorNotas extends Controller
{
    public static function getValoresMiniPautaTrimestral($id_estudante, $epoca)
    {
        $data = [
            'id_estudante' => $id_estudante,
            'epoca' => $epoca,
            'id_disciplina' => Session::get('id_disciplinaMIN'),
            'ano_lectivo' => Session::get('ano_lectivoMIN'),
        ];
        $trimestral = Trimestral::where($data)->get();
        return $trimestral;
    }
}