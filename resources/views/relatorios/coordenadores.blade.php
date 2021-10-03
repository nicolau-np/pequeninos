@php
use App\Http\Controllers\ControladorStatic;
$numero = 0;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MAPA DE COORDENADORES - {{$getAno}} - [ {{strtoupper($getEnsino->ensino)}} ]</title>

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
    </style>
</head>
<body>

    @foreach ($getCursos as $cursos)
    <div class="default-page">
        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <br/>
        <div class="titulo">
            <p style="text-align: center; font-weight:bold; font-size:15px;">MAPA DE LOCALIZAÇÃO DOS COORDENADORES DE TURMAS</p>
        </div>
        <div class="corpo">

            @foreach ($getTurnos as $turnos)
            @php
                $turmas = ControladorStatic::getTurmaTurnoCurso($turnos->id, $cursos->id);
            @endphp
            @if ($turmas->count()!=0)

            <div class="table-responsive">
                <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>NOME DO COORDENADOR</th>
                            <th>CLASSE/TURMA</th>
                            <th>SALA Nº</th>
                            <th>Nº DE ALUNOS</th>
                            <th>TELEFONE</th>
                            <th>PERÍODO</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $turmas0 = ControladorStatic::getTurmaTurnoCurso($turnos->id, $cursos->id);
                        @endphp
                        @if ($turmas0->count()!=0)
                        @foreach ($turmas0 as $turma)
                        @php
                            $numero ++;
                        @endphp
                        <tr>
                            <td>{{$numero}}</td>
                            <td>
                                @php
                                    $coordenador = ControladorStatic::getCoordenadorTurma($turma->id, $getAno);
                                @endphp
                                @if(!$coordenador)
                                ---
                                @else
                                {{strtoupper($coordenador->funcionario->pessoa->nome)}}
                                @endif
                            </td>
                            <td>{{strtoupper($turma->classe->classe)}} [ {{$turma->turma}} ]</td>
                            <td>{{strtoupper($turma->sala)}}</td>
                            <td>
                                @php
                                    $historico = ControladorStatic::getTotalEstudantesTurma($turma->id, $getAno)
                                @endphp
                                {{$historico->count()}}
                            </td>
                            <td>
                                @if(!$coordenador)
                                ---
                                @else
                                {{$coordenador->funcionario->pessoa->telefone}}
                                @endif
                            </td>
                            <td>{{strtoupper($turma->turno->turno)}}</td>
                        </tr>

                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            @endif
            @endforeach

        </div>
        <div class="rodape">

        </div>
    </div>
    @endforeach
</body>
</html>

