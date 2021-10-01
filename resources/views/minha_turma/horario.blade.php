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
                        {{$getTurma->turno->turno}}
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
                                    <th>Disciplinas</th>
                                    <th>Professor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getGrades as $grades)
                                <?php
                                    $horario = ControladorStatic::getProfDisciplina($getTurma->id, $grades->id_disciplina, $getAno);
                                ?>
                                <tr>
                                    <td>{{$grades->disciplina->disciplina}}</td>
                                    <td>
                                        @if(!$horario)
                                        <span style="font-size:11px;">
                                            sem professor
                                        </span>
                                        @else
                                        <span style="font-size:12px; color: #4680ff;">
                                        {{$horario->funcionario->pessoa->nome}}
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
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
