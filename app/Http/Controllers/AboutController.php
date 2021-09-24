<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function sistema(){
        $data = [
            'title' => "Sistema",
            'type' => "sistema",
            'menu' => "Sistema",
            'submenu' => "Sobre",

       ];
        return view('about.sistema', $data);
    }

    public function instituicao(){
        $data = [
            'title' => "Sistema",
            'type' => "sistema",
            'menu' => "Instituição",
            'submenu' => "Sobre",

       ];
        return view('about.instituicao', $data);
    }
}