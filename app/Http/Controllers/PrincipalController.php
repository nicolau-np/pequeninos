<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function index(){
        $data = [
            'title'=>"OKUSSOLEKA - Sistema de Gestão Escolar",
            'type'=>"principal",
            'menu'=>"Principal",
            'submenu'=>"",
        ];
        return view('principal.home', $data);
    }
}