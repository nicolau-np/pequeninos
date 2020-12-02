<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'title'=>"Okussoleka - Sistema de Gestão Escolar",
            'type'=>"home",
            'menu'=>"Home",
            'submenu'=>""
        ];
        return view('home', $data);
    }
}