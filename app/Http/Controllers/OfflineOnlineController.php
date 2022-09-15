<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfflineOnlineController extends Controller
{
    public function list(){

        $data = [
            'title' => "Offline/Online",
            'type' => "offline_online",
            'menu' => "Offline/Online",
            'submenu' => "Listar",
        ];
        return view('offline_online.list', $data);
    }

    public function estudantes(){
        $data = [
            'title' => "Offline/Online",
            'type' => "offline_online",
            'menu' => "Estudantes",
            'submenu' => "Listar",
        ];
        return view('offline_online.estudantes', $data);
    }
}
