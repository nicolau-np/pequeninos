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
                                {{Form::text('text_search', null, ['class'=>"form-control text_search", 'placeholder'=>"Pesquisar..."])}}
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
                                    <th>Designação</th>
                                    <th>Q. Negativa</th>
                                    <th>Operações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($getObservacoes->count()==0)
                                    Nenhuma observação registada
                                @else
                                @foreach ($getObservacoes as $observacoes)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$observacoes->curso->curso}}</td>
                                        <td>{{$observacoes->classe->classe}}</td>
                                        <td>{{$observacoes->designacao}}</td>
                                        <td>{{$observacoes->quantidade_negativas}}</td>
                                        <td>

                                            <a href="/institucional/observacoes/geral/edit/{{$observacoes->id}}" class="btn btn-primary btn-sm"><i class="ti-pencil-alt"></i> Editar</a>
                                            <a href="#" class="btn btn-danger btn-sm"><i class="ti-trash"></i> Eliminar</a>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination">
                        {{$getObservacoes->links()}}
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
		<a href="/institucional/observacoes/geral/create" class="btn btn-primary btnCircular btnPrincipal" title="Novo"><i class="ti-plus"></i></a>
	</div>
</div>
@endsection