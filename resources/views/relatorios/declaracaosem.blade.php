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
        <br/><br/><br/>
        <div class="titulo">
            <p style="text-align: center; font-weight:bold; font-size:18px;">DECLARAÇÃO</p>
         </div>

         <div class="corpo">
            <p style="text-align: justify;">

                <div class="paragrafo">
                    O ANTÓNIO KANUTULA BANGO Director do Complexo escolar nº 89M
                    "EDUARDO DOMINGOS SUKUETE" Certifico que: {{$getDeclaracao->estudante->pessoa->nome}},
                    Filho de @if($getDeclaracao->estudante->pessoa->pai){{$getDeclaracao->estudante->pessoa->pai}} @else [########################] @endif
                    e de @if($getDeclaracao->estudante->pessoa->mae){{$getDeclaracao->estudante->pessoa->mae}} @else [########################] @endif
                     Nascido (a) 20 de Dezembro de Junho de
                    2008,  natural do  Huambo Município do Huambo província do
                    Huambo, portador (a) do BI nº009857705HO040 Passado pelo
                    arquivo de Identificação de Luanda aos 12 de 12 de 2018
                </div>

            </p>

         </div>

         <div class="rodape">

         </div>
    </div>
</body>
</html>
