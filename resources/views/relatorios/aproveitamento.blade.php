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
                            <th rowspan="2">DISCIPLINA</th>
                            @foreach ($getClasses as $classes)
                            <th colspan="4">{{strtoupper($classes->classe)}}</th>
                            @endforeach
                            <th colspan="4">TOTAL</th>
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
                                    <td>{{strtoupper($getDisciplina->disciplina)}}</td>

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
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                @endforeach
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                    </tbody>
                </table>
            </div>

        </div>
        <br/><br/>
        <div class="rodape">

            <div class="data">
                <p style="text-align: center;">
                Moçamedes aos, {{date('d')}} de
                @php
                    $mes_extenso = ControladorStatic::converterMesExtensao(date('m'));

                @endphp
                {{$mes_extenso}}
                de {{date('Y')}}
                </p>
            </div>
        </div>
    </div>

</body>
</html>

