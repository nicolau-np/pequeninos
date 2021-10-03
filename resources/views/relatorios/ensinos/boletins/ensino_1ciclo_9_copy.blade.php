<?php
use App\Http\Controllers\ControladorStatic;
use App\Http\Controllers\ControladorNotas;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>BOLETIM DE NOTAS {{$getEpoca}}º TRIMESTRE - {{$getDirector->ano_lectivo}} - [ {{strtoupper($getDirector->turma->turma)}} - {{strtoupper($getDirector->turma->turno->turno)}} - {{strtoupper($getDirector->turma->curso->curso)}} ]</title>
<style>
    @page{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        margin-left: 10px;
        margin-right: 10px;
        margin-top: 10px;
        margin-bottom: 10px;
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

    .positivo{
        color: #4680ff;
    }
    .negativo{
        color: #FC6180;
    }
    .nenhum{
        color: #333;
    }
    .transferido{
    background-color:#FFB64D;
    color:#fff;
    font-weight: bold;
}
.desistencia{
    background-color:#FC6180;
    color:#fff;
    font-weight: bold;
}
    .neutro{
        color: #FFB64D;
    }
    table thead{
            background-color: #4680ff;
            color: #fff;
    }
    .tabela{
        font-size: 11px;
    }

    .title{
        font-weight: bold;
    }

    .boletim{
        padding-bottom: 15px;
        border: 1px #ccc dashed;
    }

    .data{
        padding: 4px;
    }
    .table-responsive{
        padding: 4px;
    }
</style>
</head>
<body>

    <div class="default-page">
        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <div class="titulo">
        <p style="text-align: center; font-weight:bold;">BOLETIM DE NOTAS {{$getEpoca}}º TRIMESTRE</p>
         </div>
        <div class="mini-cabecalho">
            <div class="ano_curso">
                &nbsp;&nbsp;{{$getDirector->ano_lectivo}} - [ {{strtoupper($getDirector->turma->turma)}} - {{strtoupper($getDirector->turma->curso->curso)}} ]
            </div>
            <div class="periodo">
                PERÍODO: {{strtoupper($getDirector->turma->turno->turno)}}
                &nbsp;&nbsp;
                <br/>

            </div>
         </div><br/><br/>

         <div class="corpo">

             @foreach ($getHistorico as $historico)
             <div class="boletim">

                <div class="table-responsive">
                    <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 70%;">
                        <thead>
                            <tr>
                                <th style="width:100px;">{{$getDirector->ano_lectivo}}</th>
                                <th colspan="5">
                                    {{strtoupper($getDirector->turma->turma)}} -
                                    {{strtoupper($getDirector->turma->turno->turno)}} -
                                    {{strtoupper($getDirector->turma->curso->curso)}}&nbsp;&nbsp;
                                    [&nbsp;
                                        Nº [{{$historico->numero}}] - {{strtoupper($historico->estudante->pessoa->nome)}}
                                    &nbsp;]
                                </th>
                            </tr>

                            <tr>
                                <th rowspan="2">Nº</th>
                                <th rowspan="2">DISCIPLINAS</th>
                                <th>{{$getEpoca}}º TRIMESTRE</th>
                            </tr>

                            <tr>
                                <th>MAC{{$getEpoca}}</th>
                                <th>NPP{{$getEpoca}}</th>
                                <th>PT{{$getEpoca}}</th>
                                <th>MT{{$getEpoca}}</th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
             @endforeach

         </div>
         <br/><br/>


    </div>

</body>
</html>
