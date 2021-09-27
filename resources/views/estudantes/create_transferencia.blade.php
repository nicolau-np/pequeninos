@extends('layouts.app')
@section('content')

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}}
                        <i class="ti-angle-right"></i>
                    {{$getEstudante->pessoa->nome}}
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
                   <div class="formulario">
                    @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                        {{Form::open(['method'=>"put", 'url'=>"/estudantes/store_guiatransferencia/{$getEstudante->id}"])}}
                        @csrf
                        <fieldset>
                            <legend><i class="ti-list"></i> Dados</legend>
                            <div class="row">

                                <div class="col-md-3">
                                    {{Form::label('data', "Data de Emissão")}} <span class="text-danger">*</span>
                                    {{Form::date('data', null, ['class'=>"form-control", 'placeholder'=>"Data de Emissão"])}}
                                    <div class="erro">
                                        @if($errors->has('data'))
                                        <div class="text-danger">{{$errors->first('data')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('ano_lectivo', "Ano Lectivo")}} <span class="text-danger">*</span>
                                    {{Form::select('ano_lectivo', $getAnos, $getAno, ['class'=>"form-control", 'placeholder'=>"Ano Lectivo"])}}
                                    <div class="erro">
                                        @if($errors->has('ano_lectivo'))
                                        <div class="text-danger">{{$errors->first('ano_lectivo')}}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    {{Form::label('descricao', "Descrição")}} <span class="text-danger">*</span>
                                    {{Form::textarea('descricao', null, ['class'=>"form-control", 'placeholder'=>"Descrição", 'cols'=>10, 'rows'=>4])}}
                                    <div class="erro">
                                        @if($errors->has('descricao'))
                                        <div class="text-danger">{{$errors->first('descricao')}}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-4">
                                    {{Form::submit('Salvar', ['class'=>"btn btn-primary"])}}
                                 </div>

                            </div>

                        {{Form::close()}}
                   </div>


                   <div class="tabela">
                    <div class="table-responsive">
                        <br/>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Descrição</th>
                                    <th>Data de Emissão</th>
                                    <th>Ano Lectivo</th>
                                    <th>Operações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($getDeclaracaos->count()==0)
                                <span class="not_found">Nenhuma guia de transferencia criada</span>
                                @else
                                @foreach ($getTransferencias as $transferencias)

                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$transferencias->motivo}}</td>
                                    <td>{{$declaracaos->data_emissao}}</td>
                                    <td>{{$declaracaos->ano_lectivo}}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm"><i class="ti-print"></i> Imprimir</a>
                                    </td>
                                </tr>

                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
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
		<a href="/estudantes/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>
@endsection
