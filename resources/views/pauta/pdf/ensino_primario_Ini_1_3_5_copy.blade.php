@php
use App\Http\Controllers\ControladorNotas;
use App\Http\Controllers\ControladorStatic;
$numero_colspan = 2;
$getCadeiraExame = false;
$getCadeiraRecurso = false;
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
    .neutro{
        color: #FFB64D;
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
            <table class="table table-bordered table-striped">
                <thead>

                    <tr>
                        <th rowspan="2">Nº</th>
                        <th rowspan="2" style="width:47px;">FOTO</th>
                        <th rowspan="2">NOME COMPLETO</th>
                        <th rowspan="2">G</th>
                        <?php

                        foreach(Session::get('disciplinas') as $disciplina){
                          $numero_colspan = 2;
                          $getDisciplina = ControladorStatic::getDisciplinaID($disciplina['id_disciplina']);
                          $getCadeiraExame = ControladorStatic::getExameStatus($getDirector->turma->id_curso, $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                          $getCadeiraRecurso = ControladorStatic::getRecursoStatus($getDirector->turma->id_curso, $getDirector->turma->id_classe, $disciplina['id_disciplina']);

                          if($getCadeiraExame){
                              $numero_colspan = $numero_colspan + 1;
                          }

                          if($getCadeiraRecurso){
                              $numero_colspan = $numero_colspan + 1;
                          }
                          ?>
                        <th colspan="{{$numero_colspan}}">{{strtoupper($getDisciplina->disciplina)}}</th>
                        <?php } ?>
                        <th rowspan="2">OBSERVAÇÃO</th>
                    </tr>
                    <tr>
                      @foreach (Session::get('disciplinas') as $disciplina)
                      <?php
                          $getCadeiraExame = ControladorStatic::getExameStatus($getDirector->turma->id_curso, $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                          $getCadeiraRecurso = ControladorStatic::getRecursoStatus($getDirector->turma->id_curso, $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                      ?>
                      <th>MFD</th>
                      @if($getCadeiraExame)
                      <th>NPE</th>
                      @endif
                      <th>MF</th>
                      @if($getCadeiraRecurso)
                      <th>REC</th>
                      @endif
                      @endforeach
                   </tr>
                </thead>
                <tbody>

                  @foreach ($getHistorico as $historico)

                    <tr class="{{$historico->observacao_final}}">
                      <td>{{$loop->iteration}}</td>
                      <td>
                          <img src="
                              @if($historico->estudante->pessoa->foto)
                              {{asset($historico->estudante->pessoa->foto)}}
                              @else
                              {{asset('assets/template/images/profile.png')}}
                              @endif
                              " alt="" style="width:47px; height:47px; border-radius:4px;">
                      </td>
                      <td>{{$historico->estudante->pessoa->nome}}</td>
                      <td>{{$historico->estudante->pessoa->genero}}</td>

                      <?php
                      foreach (Session::get('disciplinas') as $disciplina) {

                          $getCadeiraExame = ControladorStatic::getExameStatus($getDirector->turma->id_curso, $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                          $getCadeiraRecurso = ControladorStatic::getRecursoStatus($getDirector->turma->id_curso, $getDirector->turma->id_classe, $disciplina['id_disciplina']);
                          $final = ControladorNotas::getValoresPautaFinalPDF($historico->id_estudante, $disciplina["id_disciplina"], $getDirector->ano_lectivo);
                          if($final->count() == 0){
                          ?>
                          <td>---</td>
                          @if ($getCadeiraExame)
                          <td>---</td>
                          @endif
                          <td>---</td>
                          @if ($getCadeiraRecurso)
                          <td>---</td>
                          @endif
                      <?php } else {
                          foreach ($final as $valorf) {
                          $v1_estilo = ControladorNotas::nota_10Qualitativa($valorf->mfd);
                          if($getCadeiraExame){
                          $v2_estilo = ControladorNotas::nota_10Qualitativa($valorf->npe);
                          }
                          $v3_estilo = ControladorNotas::nota_10Qualitativa($valorf->mf);
                          if($getCadeiraRecurso){
                          $v4_estilo = ControladorNotas::notaRec_5($valorf->rec);
                          }

                          $v1_valor = ControladorNotas::estado_nota_qualitativa($valorf->mfd);
                          if($getCadeiraExame){
                          $v2_valor = ControladorNotas::estado_nota_qualitativa($valorf->npe);
                          }
                          $v3_valor = ControladorNotas::estado_nota_qualitativa($valorf->mf);
                          if($getCadeiraRecurso){
                          $v4_valor = ControladorNotas::estado_nota_qualitativaRec($valorf->rec);
                          }
                          ?>
                          <td class="{{$v1_estilo}}">@if($valorf->mfd==null) --- @else {{$v1_valor}} @endif</td>
                          @if ($getCadeiraExame)
                              <td class="{{$v2_estilo}}">@if($valorf->npe==null) --- @else {{$v2_valor}} @endif</td>
                          @endif
                          <td class="{{$v3_estilo}}">@if($valorf->mf==null) --- @else {{$v3_valor}} @endif</td>
                          @if ($getCadeiraRecurso)
                              <td class="{{$v4_estilo}}">@if($valorf->rec==null) --- @else {{$v4_valor}} @endif</td>
                          @endif

                      <?php }

                          }
                          }
                          ?>
                          <!-- obs -->
                          <td>-----</td>
                           <!-- fim obs-->
                    </tr>
                    @endforeach
                </tbody>
             </table>
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
