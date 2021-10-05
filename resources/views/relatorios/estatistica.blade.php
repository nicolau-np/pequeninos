@php
use App\Http\Controllers\ControladorStatic;
use App\Http\Controllers\ControladorNotas;
$numero = 0;
$matriculados = [
    'mf'=>0,
    'f'=>0,
];

$desistidos = [
    'mf'=>0,
    'f'=>0,
];



@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FICHA DE ESTATÍSTICA - {{$getEpoca}}º TRIMESTRE - {{$getAno}} - [ {{strtoupper($getEnsino->ensino)}} ]</title>

    <style>
        @page{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
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
            font-size: 12px;
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
            <p style="text-align: center; font-weight:bold; font-size:15px;">FICHA DE ESTATÍSTICA TRIMESTRAL</p>
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
                            <th rowspan="2">CLASSES</th>
                            <th colspan="2">MATRICULADOS</th>
                            <th colspan="2">DESISTIDOS</th>
                            <th colspan="2">TRANSFERIDOS</th>
                            <th colspan="2">CHEGADOS AO FIM</th>
                        </tr>
                        <tr>
                            <th>MF</th>
                            <th>F</th>
                            <th>MF</th>
                            <th>F</th>
                            <th>MF</th>
                            <th>F</th>
                            <th>MF</th>
                            <th>F</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getClasses as $classes)
                        @php
                            $matriculados['mf'] = 0;
                            $matriculados['f'] = 0;
                            $getHistoricoMatriculados = ControladorStatic::getEstatisticaMariculados($classes->id, $getAno);
                            foreach ($getHistoricoMatriculados as $historicomatriculados){
                                if(($historicomatriculados->estudante->pessoa->genero=="F") || ($historicomatriculados->estudante->pessoa->genero=="f")){
                                    $matriculados['f'] ++;
                                }
                                $matriculados['mf']++;
                            }

                            $getHistoricoDesistidos = ControladorStatic::getEstatisticaDesistidos($classes->id, $getAno);
                            foreach ($getHistoricoDesistidos as $historicodesistidos) {
                                
                            }
                        @endphp
                        <tr>
                            <td>{{strtoupper($classes->classe)}}</td>
                            <td>{{$matriculados['mf']}}</td>
                            <td>{{$matriculados['f']}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>TOTAL</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
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

            <div class="director">
                <p style="text-align: center;">
                    O Director da escola<br/>
                    -------------------------------------------------<br/>
                    LIC. ANTÓNIO KANUTULA BANGO
                 </p>
            </div>
        </div>
    </div>

</body>
</html>

