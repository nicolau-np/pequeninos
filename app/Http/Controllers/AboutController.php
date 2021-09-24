<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function sistema(){
        $data = [
            'title' => "Sistema",
            'type' => "acerca",
            'menu' => "Sistema",
            'submenu' => "Acerca",

       ];
        return view('about.sistema', $data);
    }

    public function instituicao(){
        $data = [
            'title' => "Instituição",
            'type' => "acerca",
            'menu' => "Instituição",
            'submenu' => "Acerca",

       ];
        return view('about.instituicao', $data);
    }
}