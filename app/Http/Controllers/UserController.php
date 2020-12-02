<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function loginForm(){
        $data = [
            'title'=>"Iniciar Sessão",
            'type'=>"login",
            'menu'=>"Login",
            'submenu'=>""
        ];
        return view('user.login', $data);
    }

    
}