<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DECLARAÇÃO SEM NOTAS {{$getDeclaracao->ano_lectivo}} - [ {{strtoupper($getDeclaracao->estudante->pessoa->nome)}} ] </title>
    <style>
        @page{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

    </style>
</head>
<body>
    <div class="default-page">
        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <div class="titulo">
            <p style="text-align: center; font-weight:bold;">DECLARAÇÃO</p>
         </div>
         <br/><br/><br/><br/>
         <div class="corpo">

         </div>

         <div class="rodape">

         </div>
    </div>
</body>
</html>
