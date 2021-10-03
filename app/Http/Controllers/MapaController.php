<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => "Sistema",
            'type' => "acerca",
            'menu' => "Sistema",
            'submenu' => "Acerca",

        ];
        return view('about.sistema', $data);
    }
}