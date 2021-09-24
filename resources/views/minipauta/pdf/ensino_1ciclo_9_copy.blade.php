<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>MINI-PAUTA {{$getHorario->ano_lectivo}} [{{strtoupper($getHorario->turma->turma)}}-{{strtoupper($getHorario->turma->turno->turno)}}-{{strtoupper($getHorario->turma->curso->curso)}}-{{strtoupper($getHorario->disciplina->disciplina)}} ]</title>
<style>
    .page-break{
        page-break-before: always;
    }

    @page{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
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

    table thead{
            background-color: #4680ff;
            color: #fff;
    }
</style>
</head>
<body>

    <div class="default-page">

        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <div class="titulo">
            <p style="text-align: center; font-weight:bold;">MINI-PAUTA DE AVALIAÇÃO ANUAL</p>
         </div>
        <div class="mini-cabecalho">
            <div class="ano_curso">
                {{$getHorario->ano_lectivo}} - [ {{strtoupper($getHorario->turma->turma)}} - {{strtoupper($getHorario->turma->curso->curso)}} ]
            </div>
            <div class="periodo">
                PERÍODO: {{strtoupper($getHorario->turma->turno->turno)}}<br/>
            </div>
         </div>
         <br/><br/>
         <div class="corpo">
            corpo
         </div>
         <br/><br/>
         <div class="rodape">
            rodape
         </div>

    </div>


    <div class="page-break">
        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <div class="titulo">
            <p style="text-align: center; font-weight:bold;">MINI-PAUTA DE AVALIAÇÃO ANUAL</p>
         </div>
        <div class="mini-cabecalho">
            <div class="ano_curso">
                {{$getHorario->ano_lectivo}} - [ {{strtoupper($getHorario->turma->turma)}} - {{strtoupper($getHorario->turma->curso->curso)}} ]
            </div>
            <div class="periodo">
                PERÍODO: {{strtoupper($getHorario->turma->turno->turno)}}<br/>
            </div>
         </div>
         <br/><br/>
         <div class="corpo">
            corpo
         </div>
         <br/><br/>
         <div class="rodape">
            rodape
         </div>
    </div>


    <div class="page-break">
        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <div class="titulo">
            <p style="text-align: center; font-weight:bold;">MINI-PAUTA DE AVALIAÇÃO ANUAL</p>
         </div>
        <div class="mini-cabecalho">
            <div class="ano_curso">
                {{$getHorario->ano_lectivo}} - [ {{strtoupper($getHorario->turma->turma)}} - {{strtoupper($getHorario->turma->curso->curso)}} ]
            </div>
            <div class="periodo">
                PERÍODO: {{strtoupper($getHorario->turma->turno->turno)}}<br/>
            </div>
         </div>
         <br/><br/>
         <div class="corpo">
            corpo
         </div>
         <br/><br/>
         <div class="rodape">
            rodape
         </div>
     </div>


</body>
</html>
