@php
use App\Http\Controllers\ControladorStatic;
use App\Http\Controllers\ControladorNotas;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DECLARAÇÃO SEM NOTAS {{$getHistorico->ano_lectivo}} - [ {{strtoupper($getHistorico->estudante->pessoa->nome)}} ] </title>
    <style>
        @page{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }
    </style>
</head>
<body>

</body>
</html>

