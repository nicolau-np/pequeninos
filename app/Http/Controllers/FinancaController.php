<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinancaController extends Controller
{
    public function __construct()
    {
       $this->middleware('admin'); 
    }
    
    public function tabela_preco_list(){
        echo "list";
    }

    public function tabela_preco_create(){
        
    }

    public function tabela_preco_store(Request $request){
        
    }

    public function tabela_preco_edit($id){
        
    }

    public function tabela_preco_update(Request $request, $id){
        
    }
}