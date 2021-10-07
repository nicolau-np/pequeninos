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
            line-height: 17.5pt;
            text-align: justify;
        }

    </style>
</head>
<body>
    <div class="default-page">
        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <br/>
        <div class="titulo">
            <p style="text-align: center; font-weight:bold; font-size:18px;">DECLARAÇÃO</p>
         </div>

         <div class="corpo">
            <p style="text-align: justify;">

                <div class="primeiro-paragrafo">
                    O ANTÓNIO KANUTULA BANGO Director do Complexo escolar nº 89M
                    "EDUARDO DOMINGOS SUKUETE" Certifico que: <b>{{$getHistorico->estudante->pessoa->nome}}</b>,
                    Filho de @if($getHistorico->estudante->pessoa->pai){{$getHistorico->estudante->pessoa->pai}} @else [########################] @endif
                    e de @if($getHistorico->estudante->pessoa->mae){{$getHistorico->estudante->pessoa->mae}} @else [########################] @endif
                     Nascido (a) {{date('d', strtotime($getHistorico->estudante->pessoa->data_nascimento))}}
                     de
                     @php
                        $mes_compreensao = date('m', strtotime($getHistorico->estudante->pessoa->data_nascimento));
                        $mes_extenso = ControladorStatic::converterMesExtensao($mes_compreensao);
                     @endphp
                     de {{$mes_extenso}} de
                     {{date('Y', strtotime($getHistorico->estudante->pessoa->data_nascimento))}},  natural de
                     @if($getHistorico->estudante->pessoa->naturalidade){{$getHistorico->estudante->pessoa->naturalidade}} @else [########################] @endif
                    Município de {{$getHistorico->estudante->pessoa->municipio->municipio}} província de
                    {{$getHistorico->estudante->pessoa->municipio->provincia->provincia}}, portador (a) do Bilhete de Identidade Nº
                    @if($getHistorico->estudante->pessoa->bilhete){{$getHistorico->estudante->pessoa->bilhete}}, @else [########################] @endif Passado pelo
                    arquivo de Identificação de Luanda aos
                    @if($getHistorico->estudante->pessoa->data_emissao)
                    {{date('d', strtotime($getHistorico->estudante->pessoa->data_emissao))}} de
                    @php
                        $mes_compreensao = date('m', strtotime($getHistorico->estudante->pessoa->data_emissao));
                        $mes_extenso = ControladorStatic::converterMesExtensao($mes_compreensao);
                     @endphp
                     {{$mes_extenso}} de
                     {{date('Y', strtotime($getHistorico->estudante->pessoa->data_emissao))}}.
                    @else [########################]. @endif
                </div>
                <br/>

                <div class="segundo-paragrafo">
                    Por ser verdade e me ter sido solicitado, mandei passar a presente declaração que vai por mim assinada e autenticada com o carimbo a óleo, em uso nesta instituição escola.
                </div>
                <br/>
                <br/>
                <br/>

            </p>

         </div>

         <div class="rodape">
            <p style="text-align: center;">
                <span class="data">
                    Moçamedes, aos {{date('d', strtotime($getDeclaracao->data_emissao))}} de
                    @php
                        $mes_compreensao = date('m', strtotime($getDeclaracao->data_emissao));
                        $mes_extenso = ControladorStatic::converterMesExtensao($mes_compreensao);
                     @endphp
                     {{$mes_extenso}}
                    de {{date('Y', strtotime($getDeclaracao->data_emissao))}}
                </span>
                <br/>
                <br/>
                <span class="director">
                    O Director da escola<br/>
                -------------------------------------------------<br/>
                LIC. ANTÓNIO KANUTULA BANGO
                </span>
            </p>
         </div>
    </div>
</body>
</html>
