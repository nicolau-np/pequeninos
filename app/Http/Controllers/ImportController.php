<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index(){
        $data = [
            'title'=>"Okussoleka - Sistema de Gestão Escolar",
            'type'=>"home",
            'menu'=>"Home",
            'submenu'=>"",
        ];

        return view('import.new', $data);
    }

    public function show(){
        
    }
    public function store(){
        
    }
}