@php
use App\Http\Controllers\ControladorStatic;
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
                $turnos = ControladorStatic::getTurmaTurnoCurso($turnos->id, $cursos->id);
            @endphp
            @if ($turnos->count()==0)

            @else

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
                        <tr>
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
            @endif
            @endforeach

        </div>
        <div class="rodape">

        </div>
    </div>
    @endforeach
</body>
</html>

