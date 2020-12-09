<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$getHistorico->estudante->pessoa->nome}}</title>
</head>
<body>
    <div class="header">
        <div class="desc_empresa">
            
        </div>
    </div>

    @if ($getId_tipo_pagamento==3)
        Comparticipacao de Pais
    @else
        Proprina
    @endif
</body>
</html>