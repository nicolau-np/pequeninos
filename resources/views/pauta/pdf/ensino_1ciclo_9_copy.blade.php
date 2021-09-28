@php
use App\Http\Controllers\ControladorNotas;
use App\Http\Controllers\ControladorStatic;
$observacao_geral = ControladorNotas::observacao_geral($getDirector->turma->classe->id,$getDirector->turma->curso->id);
if(!$observacao_geral){
    $observacao_geralDB=22;
}else{
    $observacao_geralDB= $observacao_geral->quantidade_negativas;
}
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PAUTA {{$getDirector->ano_lectivo}} [ {{strtoupper($getDirector->turma->turma)}}-{{strtoupper($getDirector->turma->turno->turno)}}-{{strtoupper($getDirector->turma->curso->curso)}} ]</title>
</head>

<style>
    .page-break{
        page-break-before: always;
    }

    @page{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 9px;
        margin-left: 10px;
        margin-right: 10px;
        margin-top: 10px;
        margin-bottom: 10px;
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
    table thead{
            background-color: #4680ff;
            color: #fff;
    }
    .tabela{
        font-size: 9px;
    }

    .teacher_name{
        display: block;
    }

    .subdirector{
        float: left;
        text-align: center;
    }

    .director{
        float: right;
        text-align: center;
    }

    .directorTurma{
        text-align: center;
        float:center;
    }
</style>

<body>

    <div class="default-page">
        <div class="cabecalho">
            @include('include.header_docs')
        </div>
        <div class="titulo">
            <p style="text-align: center; font-weight:bold;">MAPA DE AVALIAÇÃO ANUAL</p>
         </div>
        <div class="mini-cabecalho">
            <div class="ano_curso">
                &nbsp;&nbsp;{{$getDirector->ano_lectivo}} - [ {{strtoupper($getDirector->turma->turma)}} - {{strtoupper($getDirector->turma->curso->curso)}} ]
            </div>
            <div class="periodo">
                PERÍODO: {{strtoupper($getDirector->turma->turno->turno)}}
                &nbsp;&nbsp;
                <br/>

            </div>
         </div>
         <br/>
         <div class="corpo">
            <div class="table-responsive">
                <table class="tabela" border="1" cellspacing=0 cellpadding=2 bordercolor="#000" style="width: 100%;">
                    <thead>

                        <tr>
                            <th rowspan="2">Nº</th>
                            <th rowspan="2">NOME COMPLETO</th>
                            <th rowspan="2">G</th>
                            <?php
                            foreach(Session::get('disciplinas') as $disciplina){
                              $getDisciplina = ControladorStatic::getDisciplinaID($disciplina['id_disciplina'])
                              ?>
                            <th colspan="3">{{strtoupper($getDisciplina->disciplina)}}</th>
                            <?php } ?>
                            <th rowspan="2">OBSERVAÇÃO</th>
                        </tr>
                        <tr>
                          @foreach (Session::get('disciplinas') as $disciplina)
                          <th>MFD</th>
                          <th>NPE</th>
                          <th>MF</th>
                          @endforeach
                       </tr>
                    </thead>
                    <tbody>
                        <?php
                          $defice_disciplinas = [];
                          $count_obs=0;
                          $observacao_final = false;

                          $numero_cadeiras = 0;
                          $numero_lancados = 0;
                        ?>
                      @foreach ($getHistorico as $historico)
                          <?php
                                  $numero_cadeiras = 0;
                                  $numero_lancados = 0;
                                  $observacao_final = false;
                                  $count_obs = 0;
                                  $observacao_especifica=false;

                                  $defice_disciplinas = [];
                          ?>
                       <tr class="{{$historico->observacao_final}}">
                          <td>{{$loop->iteration}}</td>
                          <td>{{$historico->estudante->pessoa->nome}}</td>
                          <td>{{$historico->estudante->pessoa->genero}}</td>

                          <?php
                          foreach (Session::get('disciplinas') as $disciplina) {
                              $numero_cadeiras = $numero_cadeiras + 1;
                              $final = ControladorNotas::getValoresPautaFinalPDF($historico->id_estudante, $disciplina["id_disciplina"], $getDirector->ano_lectivo);
                              if($final->count() == 0){
                              ?>
                              <td>---</td>
                              <td>---</td>
                              <td>---</td>
                          <?php } else {
                              foreach ($final as $valorf) {
                              $v1_estilo = ControladorNotas::nota_20($valorf->mfd);
                              $v2_estilo = ControladorNotas::nota_20($valorf->npe);
                              $v3_estilo = ControladorNotas::nota_20($valorf->mf);
                              ?>
                              <td class="{{$v1_estilo}}">@if($valorf->mfd == null) --- @else {{$valorf->mfd}} @endif</td>
                              <td class="{{$v2_estilo}}">@if($valorf->npe == null) --- @else {{$valorf->npe}} @endif</td>
                              <td class="{{$v3_estilo}}">@if($valorf->mf == null) --- @else {{$valorf->mf}} @endif</td>

                          <?php }
                                  if($valorf->mf<=9.99 && $valorf->mf!=null){
                                  //conta disciplinas com negativa
                                  $count_obs ++;
                                  //adiciona disciplinas com defices no array
                                  array_push($defice_disciplinas, $valorf->disciplina->disciplina);
                                  //faz a verificacao na observacao geral do controlador static, caso encontrar entao esta reprovado a variavel observacao vai ficar true caso nao encontrar prossiga
                                  $observacao_especifica = ControladorNotas::observacao_especifica($getDirector->turma->classe->id, $getDirector->turma->curso->id, $disciplina["id_disciplina"]);
                                  }

                                  if($count_obs >= $observacao_geralDB){
                                      $observacao_final = true;
                                  }
                                  if($observacao_especifica){
                                      $observacao_final = true;
                                  }

                                  if($valorf->mf!=null){
                                  $numero_lancados = $numero_lancados +1;
                                  }
                              }


                              }
                              ?>

                              @if($numero_cadeiras != $numero_lancados)
                              <td>---</td>
                              @else
                              <td class="@if($observacao_final) negativo @else positivo @endif">
                                  @if($observacao_final)
                                       NÃO TRANSITA
                                   @else
                                   TRANSITA
                                   @if ($defice_disciplinas)
                                      [DEF.(
                                          @foreach ($defice_disciplinas as $item)
                                             {{strtoupper($item)}},
                                          @endforeach
                                          )]
                                      @endif
                                   @endif


                               </td>
                              @endif

                        </tr>
                        @endforeach
                    </tbody>
                 </table>
            </div>
         </div>
         <br/><br/>
         <div class="rodape">
            <div class="teacher_name">
                <div class="subdirector">
                    O(A) SUBDIRECTOR(A) PEDAGÓGICO<br/>
                __________________________________<br/>
                // BACH. PASCOAL VITA TCHINGALULE //
                </div>


                <div class="director">
                    O(A) DIRECTOR(A)<br/>
                    _____________________________<br/>
                    // LIC. ANTÓNIO KANUTULA BANGO //
                </div>
            </div>
         </div>
    </div>

</body>
</html>
