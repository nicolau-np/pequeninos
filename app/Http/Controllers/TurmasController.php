<?php

namespace App\Http\Controllers;

use App\Ensino;
use Illuminate\Http\Request;

class TurmasController extends Controller
{
    public function index(){
        $ensinos = Ensino::all();
        $data = [
            'title' => "Turmas",
            'type' => "turmas",
            'menu' => "Turmas",
            'submenu' => "Listar",
            'getEnsinos' => $ensinos,
        ];
        return view('turmas.list', $data);
    }
}