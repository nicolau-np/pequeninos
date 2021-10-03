@php
use App\Http\Controllers\ControladorStatic;
use App\Http\Controllers\ControladorNotas;
$numero_estudantes = 0;
$change_page = false;
$number_page = 1;
@endphp

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
        /*margin-left: 10px;
        margin-right: 10px;*/
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

    .page-changed{
        page-break-before: always;
    }
</style>
</head>
<body>


             @foreach ($getHistorico as $historico)
             @php
                if($numero_estudantes <= 2){
                    $change_page = false;
                }

                if($numero_estudantes >= 3){
                    $change_page = true;
                    $numero_estudantes = 0;
                    $number_page ++;
                }
                $numero_estudantes ++;
             @endphp


             <div class="@if($change_page) page-changed @endif">

                <div class="table-responsive">
                    <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 70%;">
                        <thead>
                            <tr>
                                <th style="width:60px;">{{$getDirector->ano_lectivo}}</th>
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
                                <th colspan="4">{{$getEpoca}}º TRIMESTRE</th>
                            </tr>

                            <tr>
                                <th>MAC{{$getEpoca}}</th>
                                <th>NPP{{$getEpoca}}</th>
                                <th>PT{{$getEpoca}}</th>
                                <th>MT{{$getEpoca}}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach (Session::get('disciplinas') as $disciplina)
                            @php
                                $getDisciplina = ControladorStatic::getDisciplinaID($disciplina['id_disciplina']);
                                $trimestral = ControladorNotas::getValoresMiniPautaTrimestralPDF($disciplina['id_disciplina'], $historico->id_estudante, $getEpoca, $getDirector->ano_lectivo);
                            @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{strtoupper($getDisciplina->disciplina)}}</td>

                                @if ($trimestral->count()==0)
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                <td>---</td>
                                @else
                                    @foreach ($trimestral as $valor1)
                                    @php
                                        $v1_estilo = ControladorNotas::nota_10($valor1->mac);
                                        $v2_estilo = ControladorNotas::nota_10($valor1->npp);
                                        $v3_estilo = ControladorNotas::nota_10($valor1->pt);
                                        $v4_estilo = ControladorNotas::nota_10($valor1->mt);
                                    @endphp
                                        <td class="{{$v1_estilo}}">@if($valor1->mac==null) --- @else {{$valor1->mac}} @endif</td>
                                        <td class="{{$v2_estilo}}">@if($valor1->npp==null) --- @else {{$valor1->npp}} @endif</td>
                                        <td class="{{$v3_estilo}}">@if($valor1->pt==null) --- @else {{$valor1->pt}} @endif</td>
                                        <td class="{{$v4_estilo}}">@if($valor1->mt==null) --- @else {{$valor1->mt}} @endif</td>
                                    @endforeach
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <hr/>
            @if($numero_estudantes==3)
                Page {{$number_page}}
            @endif
            @endforeach

</body>
</html>
