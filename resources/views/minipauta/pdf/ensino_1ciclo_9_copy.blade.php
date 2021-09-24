<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>MINI PAUTA {{$getHorario->ano_lectivo}} [{{strtoupper($getHorario->turma->turma)}}-{{strtoupper($getHorario->turma->turno->turno)}}-{{strtoupper($getHorario->turma->curso->curso)}}-{{strtoupper($getHorario->disciplina->disciplina)}} ]</title>
<style>
    .page-break{
        page-break-before: always;
    }
</style>
</head>
<body>

    <div class="default-page">
        pagina 1
    </div>
    <div class="page-break">
        pagina 2
    </div>

    <div class="page-break">
        pagina 3
     </div>
</body>
</html>
