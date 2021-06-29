<?php
use \App\Http\Controllers\ControladorStatic;
?>
@extends('layouts.app')
@section('content')
<style>
    .prof{
        color: #4680ff;
    }
    .disciplina{
        font-weight: bold;
    }
    .sala{
        font-size: 12px;
    }
</style>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}}
                        <i class="ti-angle-right"></i>
                        {{$getTurma->turma}}
                        <i class="ti-angle-right"></i>
                        {{$getTurma->curso->curso}}
                        <i class="ti-angle-right"></i>
                        {{$getAno}}
                    </h5>
                    <span></span>
                    <div class="card-header-right">

                        <ul class="list-unstyled card-option" style="width: 35px;">
                            <li class=""><i class="icofont icofont-simple-left"></i></li>
                            <li><i class="icofont icofont-maximize full-card"></i></li>
                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                  <div class="tabe">
                      <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Hora</th>
                                    <th>Segunda</th>
                                    <th>Terça</th>
                                    <th>Quarta</th>
                                    <th>Quinta</th>
                                    <th>Sexta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $semana = null;
                                    foreach($getHora as $hora ){
                                        if($hora->id_turno == $getTurma->id_turno){
                                    ?>
                                <tr>
                                <td>{{$hora->hora_entrada}} - {{$hora->hora_saida}}</td>
                                    <td>
                                        <?php
                                          $semana = "Segunda";
                                         $horario = ControladorStatic::getHorario($hora->id, $getTurma->id, $getAno, $semana);
                                        ?>
                                        @if ($horario->count()!=0)
                                        <span class="disciplina">{{$horario[0]->disciplina->disciplina}}</span><br/>
                                            <span class="prof">{{$horario[0]->funcionario->pessoa->nome}}</span><br/>
                                            <span class="sala">{{$horario[0]->sala->sala}}</span>
                                        @else
                                        ---
                                        @endif

                                    </td>

                                    <td>
                                    <?php
                                    $semana = "Terça";
                                   $horario = ControladorStatic::getHorario($hora->id, $getTurma->id, $getAno, $semana);
                                  ?>
                                  @if ($horario->count()!=0)
                                  <span class="disciplina">{{$horario[0]->disciplina->disciplina}}</span><br/>
                                      <span class="prof">{{$horario[0]->funcionario->pessoa->nome}}</span><br/>
                                      <span class="sala">{{$horario[0]->sala->sala}}</span>
                                  @else
                                  ---
                                  @endif
                                    </td>


                                    <td>
                                        <?php
                                          $semana = "Quarta";
                                         $horario = ControladorStatic::getHorario($hora->id, $getTurma->id, $getAno, $semana);
                                        ?>
                                        @if ($horario->count()!=0)
                                        <span class="disciplina">{{$horario[0]->disciplina->disciplina}}</span><br/>
                                            <span class="prof">{{$horario[0]->funcionario->pessoa->nome}}</span><br/>
                                            <span class="sala">{{$horario[0]->sala->sala}}</span>
                                        @else
                                        ---
                                        @endif
                                    </td>


                                    <td>
                                        <?php
                                          $semana = "Quinta";
                                         $horario = ControladorStatic::getHorario($hora->id, $getTurma->id, $getAno, $semana);
                                        ?>
                                        @if ($horario->count()!=0)
                                        <span class="disciplina">{{$horario[0]->disciplina->disciplina}}</span><br/>
                                            <span class="prof">{{$horario[0]->funcionario->pessoa->nome}}</span><br/>
                                            <span class="sala">{{$horario[0]->sala->sala}}</span>
                                        @else
                                        ---
                                        @endif
                                    </td>


                                    <td>
<?php
                                          $semana = "Sexta";
                                         $horario = ControladorStatic::getHorario($hora->id, $getTurma->id, $getAno, $semana);
                                        ?>
                                        @if ($horario->count()!=0)
                                            <span class="disciplina">{{$horario[0]->disciplina->disciplina}}</span><br/>
                                            <span class="prof">{{$horario[0]->funcionario->pessoa->nome}}</span><br/>
                                            <span class="sala">{{$horario[0]->sala->sala}}</span>
                                        @else
                                        ---
                                        @endif
                                    </td>
                                </tr>
                            <?php }}?>
                            </tbody>
                      </table>
                  </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- hidden-sm-up -->

<!-- botão pesquisar -->

@endsection
