<?php

namespace App\Http\Controllers;

use App\AnoLectivo;
use App\Encarregado;
use App\Pessoa;
use App\Provincia;
use Illuminate\Http\Request;

class EncarregadoController extends Controller
{
  

    public function index()
    {

        $encarregados = Encarregado::paginate(5);
        $anos = AnoLectivo::pluck('ano_lectivo', 'id');
        $data = [
            'title' => "Encarregados",
            'type' => "encarregados",
            'menu' => "Encarregados",
            'submenu' => "Listar",
            'getEncarregados' => $encarregados,
            'getAnos'=>$anos,
        ];
        return view('encarregados.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincias = Provincia::pluck('provincia', 'id');
        $data = [
            'title' => "Encarregados",
            'type' => "encarregados",
            'menu' => "Encarregados",
            'submenu' => "Novo",
            'getProvincias' => $provincias,
        ];
        return view('encarregados.new', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'=>['required', 'string', 'min:7', 'max:255'],
            'genero'=>['required', 'string'],
            'provincia'=>['required', 'Integer'],
            'municipio'=>['required', 'Integer'],
            'telefone'=>['required', 'Integer'],
        ]);

        $data['pessoa'] = [
            'nome'=>$request->nome,
            'genero'=>$request->genero,
            'id_municipio'=>$request->municipio,
            'telefone'=>$request->telefone,
        ];

        $data['encarregado'] = [
            'id_pessoa'=>null,
            'estado'=>"on",
        ];

        if(Pessoa::where($data['pessoa'])->first()){
            return back()->with(['error'=>"Já cadastrou este encarregado"]);
        }

        $pessoa = Pessoa::create($data['pessoa']);
        if($pessoa){
            $data['encarregado']['id_pessoa'] = $pessoa->id;
            if(Encarregado::create($data['encarregado'])){
                return back()->with(['success'=>"Feito com sucesso"]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $encarregado = Encarregado::find($id);
        if(!$encarregado){
            return back()->with(['error'=>"Não encontrou encarregado"]);
        }

        $provincias = Provincia::pluck('provincia', 'id');
        $data = [
            'title' => "Encarregados",
            'type' => "encarregados",
            'menu' => "Encarregados",
            'submenu' => "Editar",
            'getProvincias' => $provincias,
            'getEncarregado'=>$encarregado,
        ];
        return view('encarregados.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $encarregado = Encarregado::find($id);
        if(!$encarregado){
            return back()->with(['error'=>"Não encontrou encarregado"]);
        }

        $request->validate([
            'nome'=>['required', 'string', 'min:7', 'max:255'],
            'genero'=>['required', 'string'],
            'provincia'=>['required', 'Integer'],
            'municipio'=>['required', 'Integer'],
            'telefone'=>['required', 'Integer'],
        ]);

        $data['pessoa'] = [
            'nome'=>$request->nome,
            'genero'=>$request->genero,
            'id_municipio'=>$request->municipio,
            'telefone'=>$request->telefone,
        ];

        if($request->nome!=$encarregado->pessoa->nome || $request->genero!=$encarregado->pessoa->genero
        || $request->municipio!=$encarregado->pessoa->id_municipio || $request->telefone!=$encarregado->pessoa->telefone){
           if(Pessoa::where($data['pessoa'])->first()){
            return back()->with(['error'=>"Já cadastrou este encarregado"]);
            }
        }


        $pessoa = Pessoa::find($encarregado->pessoa->id)->update($data['pessoa']);
        if($pessoa){
            return back()->with(['success'=>"Feito com sucesso"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}