@php
use App\Http\Controllers\ControladorStatic;
use App\Http\Controllers\ControladorNotas;
$numero = 0;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MAPA DE ESTATÍSTICA - {{$getEpoca}}º TRIMESTRE - {{$getAno}} - [ {{strtoupper($getEnsino->ensino)}} ]</title>

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

