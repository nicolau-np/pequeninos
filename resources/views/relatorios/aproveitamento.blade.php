@php
use App\Http\Controllers\ControladorStatic;
use App\Http\Controllers\ControladorNotas;
$numero = 0;

$dados = [
    'pos'=>0,
    'neg'=>0,
    'total'=>0,
    'percent'=>0,
];

$dadosGerais = [
    'pos'=>0,
    'neg'=>0,
    'total'=>0,
    'percent'=>0,
];

$dados01 = [
    'pos'=>0,
    'neg'=>0,
    'total'=>0,
    'percent'=>0,
];

$dadosGerais01 = [
    'pos'=>0,
    'neg'=>0,
    'total'=>0,
    'percent'=>0,
];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MAPA DE APROVEITAMENTO - {{$getEpoca}}º TRIMESTRE - {{$getAno}} - [ {{strtoupper($getEnsino->ensino)}} ]</title>

    <style>
        @page{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
            margin-left: 10px;
            margin-right: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .page-break{
            page-break-before: always;
        }

        table thead{
            background-color: #4680ff;
            color: #fff;
        }
        .tabela{
            font-size: 10px;
        }
        .mini-cabecalho{
        display: block;
    }
    .ano_curso{
        float: left;
    }
    .periodo{
        float: right;
    }
    </style>
</head>
<body>

    <div class="default-page">
        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <br/>
        <div class="titulo">
            <p style="text-align: center; font-weight:bold; font-size:15px;">MAPA DE APROVEITAMENTO OBTIDO POR DISCIPLINA</p>
        </div>
        <div class="mini-cabecalho">
            <div class="ano_curso">
            &nbsp;&nbsp;{{$getAno}} - [ {{strtoupper($getCurso->curso)}} ] &nbsp;&nbsp; [ {{$getEpoca}}º TRIMESTRE ]
            </div>
            <div class="periodo">
                ENSINO: [ {{strtoupper($getEnsino->ensino)}} ]
                &nbsp;&nbsp;
                <br/>

            </div>
         </div>
         <br/>
        <div class="corpo">

            <div class="table-responsive">
                <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
                    <thead>
                        <tr>
                            <th rowspan="2">DISCIPLINAS</th>
                            @foreach ($getClasses as $classes)
                            <th colspan="4">{{$classes->classe}}</th>
                            @endforeach
                            <th colspan="4">Total</th>
                        </tr>

                        <tr>
                            @foreach ($getClasses as $classes)
                            <th>POS</th>
                            <th>NEG</th>
                            <th>TOTAL</th>
                            <th>%</th>
                            @endforeach
                            <th>POS</th>
                            <th>NEG</th>
                            <th>TOTAL</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>


                            @foreach (Session::get('disciplinas') as $disciplina)

                                @php
                                    $dados['pos'] =0;
                                    $dados['neg'] =0;
                                    $dados['total'] =0;
                                    $dados['percent']=0;

                                    $dadosGerais ['pos'] = 0;
                                    $dadosGerais['neg'] =0;
                                    $dadosGerais['total'] =0;
                                    $dadosGerais['percent'] =0;

                                    $getDisciplina = ControladorStatic::getDisciplinaID($disciplina['id_disciplina']);
                                @endphp
                                <tr>
                                    <td>{{$getDisciplina->disciplina}}</td>

                                    @foreach ($getClasses as $classes)
                                    @php
                                    $dados['pos'] =0;
                                    $dados['neg'] =0;
                                    $dados['total'] =0;
                                    $dados['percent']=0;

                                        $getNotas = ControladorNotas::getNotasEstudantesAproveitamentoDisciplina($getCurso->id, $classes->id, $getEpoca, $getDisciplina->id, $getAno);
                                        foreach ($getNotas as $notas){
                                            if($getEnsino->id==1){
                                                if($notas->mt>=5){
                                                    $dados['pos'] ++;
                                                }else{
                                                    $dados['neg']++;
                                                }
                                            }else{
                                                if($notas->mt>=10){
                                                    $dados['pos'] ++;
                                                }else{
                                                    $dados['neg']++;
                                                }
                                            }

                                        }
                                        $dados['total'] = $dados['pos']+$dados['neg'];
                                        if($dados['total']<=0){
                                            $dados['percent'] = "###";
                                        }else{
                                            $dados['percent'] = ($dados['pos']*100)/$dados['total'];
                                        }

                                        $dadosGerais['pos'] = $dadosGerais['pos']+$dados['pos'];
                                        $dadosGerais['neg'] = $dadosGerais['neg']+$dados['neg'];
                                        $dadosGerais['total'] = $dadosGerais['total']+$dados['total'];
                                        if($dadosGerais['total'] <=0){
                                            $dadosGerais['percent'] ="###";
                                        }else{
                                            $dadosGerais['percent'] = ($dadosGerais['pos']*100)/$dadosGerais['total'];
                                        }
                                    @endphp

                                    <td>{{$dados['pos']}}</td>
                                    <td>{{$dados['neg']}}</td>
                                    <td>{{$dados['total']}}</td>
                                    <td>
                                        @if($dados['total']==0)
                                            {{$dados['percent']}}
                                        @else
                                            {{round($dados['percent'],2)}}
                                        @endif
                                    </td>


                                    @endforeach

                                    <td>{{$dadosGerais['pos']}}</td>
                                    <td>{{$dadosGerais['neg']}}</td>
                                    <td>{{$dadosGerais['total']}}</td>
                                    <td>
                                        @if($dadosGerais['total']==0)
                                        {{$dadosGerais['percent']}}
                                        @else
                                        {{round($dadosGerais['percent'],2)}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>TOTAL</td>
                                @foreach ($getClasses as $classes)

                                @php
                                    $dados01['pos'] =0;
                                    $dados01['neg'] =0;
                                    $dados01['total'] =0;
                                    $dados01['percent']=0;
                                    $getNotas01 = ControladorNotas::getNotasEstudantesAproveitamentoClasse($getCurso->id, $classes->id, $getEpoca, $getAno);
                                    foreach ($getNotas01 as $notas){
                                            if($getEnsino->id==1){
                                                if($notas->mt>=5){
                                                    $dados01['pos'] ++;
                                                }else{
                                                    $dados01['neg']++;
                                                }
                                            }else{
                                                if($notas->mt>=10){
                                                    $dados01['pos'] ++;
                                                }else{
                                                    $dados01['neg']++;
                                                }
                                            }

                                        }
                                        $dados01['total'] = $dados01['pos']+$dados01['neg'];
                                        if($dados01['total']<=0){
                                            $dados01['percent'] = "###";
                                        }else{
                                            $dados01['percent'] = ($dados01['pos']*100)/$dados01['total'];
                                        }

                                        $dadosGerais01['pos'] = $dadosGerais01['pos']+$dados01['pos'];
                                        $dadosGerais01['neg'] = $dadosGerais01['neg']+$dados01['neg'];
                                        $dadosGerais01['total'] = $dadosGerais01['total']+$dados01['total'];
                                        if($dadosGerais01['total'] <=0){
                                            $dadosGerais01['percent'] ="###";
                                        }else{
                                            $dadosGerais01['percent'] = ($dadosGerais01['pos']*100)/$dadosGerais01['total'];
                                        }
                                @endphp
                                <td>{{$dados01['pos']}}</td>
                                <td>{{$dados01['neg']}}</td>
                                <td>{{$dados01['total']}}</td>
                                <td>
                                    @if ($dados01['total']<=0)
                                    {{$dados01['percent']}}
                                    @else
                                    {{round($dados01['percent'],2)}}
                                    @endif

                                </td>
                                @endforeach
                                <td>{{$dadosGerais01['pos']}}</td>
                                <td>{{$dadosGerais01['neg']}}</td>
                                <td>{{$dadosGerais01['total']}}</td>
                                <td>
                                    @if($dadosGerais01['total']<=0)
                                    {{$dadosGerais01['percent']}}
                                    @else
                                    {{round($dadosGerais01['percent'],2)}}
                                    @endif
                                </td>
                            </tr>

                    </tbody>
                </table>
            </div>

        </div>
        <br/><br/>
        <div class="rodape">

            <div class="data">
                <p style="text-align: center;">
                    Huambo aos, {{date('d')}} de
                @php
                    $mes_extenso = ControladorStatic::converterMesExtensao(date('m'));

                @endphp
                {{$mes_extenso}}
                de {{date('Y')}}
                </p>
            </div>

            <div class="director">
                <p style="text-align: center;">
                    O Director da escola<br/>
                    -------------------------------------------------<br/>
                    Aurélio Messele Tchissende
                 </p>
            </div>
        </div>
    </div>

</body>
</html>

