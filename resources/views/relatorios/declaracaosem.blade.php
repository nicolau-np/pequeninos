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

                <div class="primeiro-paragrafo">
                    O ANTÓNIO KANUTULA BANGO Director do Complexo escolar nº 89M
                    "EDUARDO DOMINGOS SUKUETE" Certifico que: <b>{{$getDeclaracao->estudante->pessoa->nome}}</b>,
                    Filho de @if($getDeclaracao->estudante->pessoa->pai){{$getDeclaracao->estudante->pessoa->pai}} @else [########################] @endif
                    e de @if($getDeclaracao->estudante->pessoa->mae){{$getDeclaracao->estudante->pessoa->mae}} @else [########################] @endif
                     Nascido (a) {{date('d', strtotime($getDeclaracao->estudante->pessoa->data_nascimento))}}
                     de
                     @php
                        $mes_compreensao = date('m', strtotime($getDeclaracao->estudante->pessoa->data_nascimento));
                        $mes_extenso = ControladorStatic::converterMesExtensao($mes_compreensao);
                     @endphp
                     de {{$mes_extenso}} de
                     {{date('Y', strtotime($getDeclaracao->estudante->pessoa->data_nascimento))}},  natural de
                     @if($getDeclaracao->estudante->pessoa->naturalidade){{$getDeclaracao->estudante->pessoa->naturalidade}} @else [########################] @endif
                    Município de {{$getDeclaracao->estudante->pessoa->municipio->municipio}} província de
                    {{$getDeclaracao->estudante->pessoa->municipio->provincia->provincia}}, portador (a) do Bilhete de Identidade Nº
                    @if($getDeclaracao->estudante->pessoa->bilhete){{$getDeclaracao->estudante->pessoa->bilhete}}, @else [########################] @endif Passado pelo
                    arquivo de Identificação de Luanda aos
                    @if($getDeclaracao->estudante->pessoa->data_emissao)
                    {{date('d', strtotime($getDeclaracao->estudante->pessoa->data_emissao))}} de
                    @php
                        $mes_compreensao = date('m', strtotime($getDeclaracao->estudante->pessoa->data_emissao));
                        $mes_extenso = ControladorStatic::converterMesExtensao($mes_compreensao);
                     @endphp
                     {{$mes_extenso}} de
                     {{date('Y', strtotime($getDeclaracao->estudante->pessoa->data_emissao))}}.
                    @else [########################] @endif
                </div>
                <br/>
                <br/>
                <div class="segundo-paragrafo">
                    Por ser verdade e me ter sido solicitado, mandei passar a presente declaração que vai por mim assinada e autenticada com o carimbo a óleo, em uso nesta instituição escola.
                </div>
                <br/>
                <br/>
            </p>

         </div>

         <div class="rodape">
            <p style="text-align: center;">
                <div class="data">
                    Huambo, ­­­­­­­­­­­­­­­­­­­­­­­­­aos 18   de Setembro de 2019
                </div>

                <div class="director">
                    O Director da escola<br/>
                -----------------------------------------------------
                LIC. ANTÓNIO KANUTULA BANGO
                </div>
            </p>
         </div>
    </div>
</body>
</html>
