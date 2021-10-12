<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsultarController extends Controller
{
    public function index()
    {
        $data = [
            'title'=>"SIGE - Sistema de Gestão Escolar",
            'type'=>"consulta",
            'menu'=>"Consultar",
            'submenu'=>"",
        ];
        return view('principal.consulta', $data);
    }
}