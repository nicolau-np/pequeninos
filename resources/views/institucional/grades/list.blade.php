<?php
use App\Http\Controllers\ControladorStatic;
?>
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
                    <div class="form">
                        {{Form::open(['class'=>"form_search", 'method'=>"post", 'url'=>"#"])}}
                        <div class="row text-right">
                            <div class="col-md-8">
                                {{Form::text('text_search', null, ['class'=>"form-control text_seach", 'placeholder'=>"Pesquisar..."])}}
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-success btn-sm"><i class="ti-search"></i></button>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>

                    <div class="table-responsive">
                        <br/>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Curso</th>
                                    <th>Classe</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($getCursos->count()==0)
                                <span class="not_found">Nenhum grade cadastrada</span>
                                @else
                                @foreach ($getCursos as $cursos)
                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                    <td>
                                        <span style="font-weight: bold; font-size:18px; color:#4680ff;">{{$cursos->curso}}</span>
                                    </td>
                                    <td>
                                        <?php
                                           $getClasses = ControladorStatic::getClassesCurso($cursos->id_ensino);
                                        ?>
                                        @foreach($getClasses as $classes)
                                        <?php
                                        $getGrades = ControladorStatic::getDisciplinasGrade($cursos->id, $classes->id);
                                        ?>
                                        <b style="color:#4680ff;">{{$classes->classe}}</b><br/>
                                            @foreach ($getGrades as $grades)
                                                <span style="font-size:10px;">{{$grades->disciplina->disciplina}}</span><br/>
                                            @endforeach
                                        <hr/>
                                        @endforeach
                                    </td>

                                </tr>

                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>

                    <div class="pagination">
                        {{$getCursos->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- hidden-sm-up -->

<!-- botão pesquisar -->
<div class="btnPesquisar">
	<div class="btnPesquisarBtn">
		<a href="/institucional/grades/create" class="btn btn-primary btnCircular btnPrincipal" title="Novo"><i class="ti-plus"></i></a>
	</div>
</div>


@endsection
