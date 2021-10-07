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
    <title>DECLARAÇÃO COM NOTAS {{$getHistorico->ano_lectivo}} - [ {{strtoupper($getHistorico->estudante->pessoa->nome)}} ] </title>
    <style>
        @page{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            line-height: 17.5pt;
            text-align: justify;
        }

        .positivo{
        color: #4680ff;
    }
    .negativo{
        color: #FC6180;
    }
    .nenhum{
        color: #333;
    }
    .transferido{
    background-color:#FFB64D;
    color:#fff;
    font-weight: bold;
}
.desistencia{
    background-color:#FC6180;
    color:#fff;
    font-weight: bold;
}
    .neutro{
        color: #FFB64D;
    }
    table thead{
            background-color: #4680ff;
            color: #fff;
    }
    table tbody tr td{
        border: 1px solid #333;
    }
    .tabela{
        font-size: 12px;
        margin:auto;
    }

    </style>
</head>
<body>
<div class="default-page">
    <div class="cabecalho">
        @include('include.header_docs')
    </div>

    <div class="titulo">
        <p style="text-align: center; font-weight:bold; font-size:18px;">DECLARAÇÃO COM NOTAS</p>
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
                 {{date('Y', strtotime($getHistorico->estudante->pessoa->data_emissao))}},
                @else [########################] @endif

                Concluiu neste Complexo Escolar nº 89M "EDUARDO DOMINGOS SUKUETE" no ano
                lectivo de [{{$getHistorico->ano_lectivo}}]  a {{$getTurma->classe->classe}}, com a seguinte classificação:
            </div>

            <div class="table-responsive">

                <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 50%;">
                    <thead>
                        <tr>
                            <td>DISCIPLINAS</td>
                            <td>NOTAS</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Session::get('disciplinas') as $disciplina)
                        @php
                        $getDisciplina = ControladorStatic::getDisciplinaID($disciplina['id_disciplina']);
                        $final = ControladorNotas::getValoresPautaFinalPDF($getHistorico->id_estudante, $disciplina["id_disciplina"], $getHistorico->ano_lectivo);
                        @endphp
                        <tr>
                            <td>{{strtoupper($getDisciplina->disciplina)}}</td>
                            @if($final->count()==0)
                                <td>---</td>
                            @else
                                @foreach ($final as $valorf)
                                    @php
                                    $v1_estilo = ControladorNotas::nota_20($valorf->mf);
                                    $v2_estilo = ControladorNotas::notaRec_10($valorf->rec);
                                    @endphp

                                    @if($valorf->rec == null)
                                        <td class="{{$v1_estilo}}">{{$valorf->mf}}</td>
                                    @else
                                        <td class="{{$v2_estilo}}">{{$valorf->rec}}</td>
                                    @endif
                                @endforeach
                            @endif
                        </tr>
                     @endforeach
                    </tbody>
                </table>

            </div>
            <br/>
            <div class="segundo-paragrafo">
                Por ser verdade e me ter sido solicitado, mandei passar a presente declaração que vai por mim assinada e autenticada com o carimbo a óleo, em uso nesta instituição escola.
            </div>

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

