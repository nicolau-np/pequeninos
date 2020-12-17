@extends('layouts.app')
@section('content')

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}}</h5>
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
                  <div class="row">
                    <div class="col-md-12">
                         @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    </div>
                   

                    @if($getHorario->count()==0)
                    Nenhuma turma encontrada
                    @else
                    @foreach ($getHorario as $horario)
                    <div class="col-md-4 col-xl-4">
                        <div class="card widget-card-1">
                            <div class="card-block-small">
                                <i class="icofont icofont-file-alt bg-c-blue card1-icon"></i>
                            <span class="text-c-blue f-w-600">{{$horario->disciplina->disciplina}}</span>
                            <h4 style="font-size:20px;">Turma: {{$horario->turma->turma}}</h4>
                                <div>
                                    <span class="f-left m-t-10 text-muted">
                                        Ano Lectivo: {{$horario->ano_lectivo}}
                                        <hr/>
                                       <div class="operacoes">
                                        <a href="/cadernetas/create/{{$horario->id_turma}}/{{$horario->id_disciplina}}/{{$horario->ano_lectivo}}/1" type="button" class="btn btn-primary btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="left" title="" data-original-title="Inserir Notas">
                                            <i class="icofont icofont-edit-alt"></i>
                                        </a>&nbsp;
                                        <a href="/minipautas/show/{{$horario->id_turma}}/{{$horario->id_disciplina}}/{{$horario->ano_lectivo}}" type="button" class="btn btn-danger btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mini Pauta">
                                            <i class="icofont icofont-clip-board"></i>
                                        </a>&nbsp;
                                        <a href="#" type="button" class="btn btn-success btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="right" title="" data-original-title="Estatística">
                                            <i class="icofont icofont-chart-bar-graph"></i>
                                        </a>&nbsp;
                                        <a href="#" type="button" class="btn btn-warning btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="right" title="" data-original-title="Baixar Excel">
                                            <i class="icofont icofont-download-alt"></i>
                                        </a>&nbsp;
                                        <a href="/cadernetas/store/{{$horario->id_turma}}/{{$horario->id_disciplina}}/{{$horario->ano_lectivo}}" type="button" class="btn btn-info btn-icon waves-effect waves-light" data-toggle="tooltip" data-placement="right" title="" data-original-title="Actualizar">
                                            <i class="icofont icofont-refresh"></i>
                                        </a>&nbsp;
                                       </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                  </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- hidden-sm-up -->

<!-- botão pesquisar -->

@endsection