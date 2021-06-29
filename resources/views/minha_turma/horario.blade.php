<?php
use \App\Http\Controllers\ControladorStatic;
?>
@extends('layouts.app')
@section('content')
<style>
    .prof{
        color: #4680ff;
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
                                    <th>Sala</th>
                                    <th>Terça</th>
                                    <th>Sala</th>
                                    <th>Quarta</th>
                                    <th>Sala</th>
                                    <th>Quinta</th>
                                    <th>Sala</th>
                                    <th>Sexta</th>
                                    <th>Sala</th>
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
                                            {{$horario[0]->disciplina->disciplina}}<br/>
                                            <span class="prof">{{$horario[0]->funcionario->pessoa->nome}}</span>
                                        @else
                                        ---
                                        @endif

                                    </td>

                                    </td>


                                    <td>

                                    </td>


                                    <td>

                                    </td>


                                    <td>

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
