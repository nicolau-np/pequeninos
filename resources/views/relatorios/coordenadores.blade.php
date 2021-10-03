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
        }
        .page-break{
            page-break-before: always;
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

        </div>
        <div class="rodape">

        </div>
    </div>
    @endforeach
</body>
</html>

