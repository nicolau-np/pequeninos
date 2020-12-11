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
                   <div class="formulario">
                    @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                        {{Form::open(['method'=>"put", 'url'=>"/directores/update/{$getDirector->id}"])}}
                        @csrf
                      
                        <fieldset>
                            <legend><i class="ti-list"></i> Dados da turma</legend>
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('curso', "Curso")}} <span class="text-danger">*</span>
                                    {{Form::select('curso', $getCursos, $getDirector->turma->id_curso, ['class'=>"form-control curso", 'placeholder'=>"Curso"])}}
                                <div class="erro">
                                    @if($errors->has('curso'))
                                    <div class="text-danger">{{$errors->first('curso')}}</div>
                                    @endif 
                                </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('classe', "Classe")}} <span class="text-danger">*</span>
                                    <span class="load_classes">
                                    {{Form::select('classe', [
                                        $getDirector->turma->id_classe=>$getDirector->turma->classe->classe
                                    ], $getDirector->turma->id_classe, ['class'=>"form-control classe", 'placeholder'=>"Classe"])}}
                                </span>
                                <div class="erro">
                                    @if($errors->has('classe'))
                                    <div class="text-danger">{{$errors->first('classe')}}</div>
                                    @endif 
                                </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('turma', "Turma")}} <span class="text-danger">*</span>
                                    <span class="load_turmas">
                                    {{Form::select('turma', [
                                        $getDirector->turma->id=>$getDirector->turma->turma
                                ], $getDirector->turma->id, ['class'=>"form-control", 'placeholder'=>"Turma"])}}
                                </span>
                                <div class="erro">
                                    @if($errors->has('turma'))
                                    <div class="text-danger">{{$errors->first('turma')}}</div>
                                    @endif 
                                </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('ano_lectivo', "Ano Lectivo")}} <span class="text-danger">*</span>
                                    {{Form::select('ano_lectivo', $getAnoLectivo, $getAno->id, ['class'=>"form-control", 'placeholder'=>"Ano Lectivo"])}}
                                
                                <div class="erro">
                                    @if($errors->has('ano_lectivo'))
                                    <div class="text-danger">{{$errors->first('ano_lectivo')}}</div>
                                    @endif 
                                </div>
                                </div>
                            </div>
                        <hr/>
                            <div class="row">
                                <div class="col-md-12">
                                    {{Form::text('funcionarioSearch', null, ['class'=>"form-control funcionarioSearch", 'placeholder'=>"Nome do Funcionário"])}}
                                </div>

                                <div class="col-md-12">
                                    <span class="load_funcionarios">
                                    <input type="radio" name="funcionario" id="funcionario" value="{{$getDirector->id_funcionario}}" checked/>{{$getDirector->funcionario->pessoa->nome}} {{$getDirector->funcionario->pessoa->telefone}}
                                    </span>
                                    <div class="erro">
                                        @if($errors->has('funcionario'))
                                        <div class="text-danger">{{$errors->first('funcionario')}}</div>
                                        @endif 
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                        <br/>
                            <div class="row">
                                <div class="col-md-4">
                                    {{Form::submit('Salvar', ['class'=>"btn btn-primary"])}}
                                 </div>

                            </div>
                        
                        {{Form::close()}}
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
		<a href="/directores/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>

<script>
    $(document).ready(function(){
        $('.curso').change(function(e){
            e.preventDefault();
            var data = {
                id_curso: $(this).val(),
                _token: "{{ csrf_token() }}"
            };
            if(data.id_curso!=""){
                $.ajax({
                type: "post",
                url: "{{route('getClasses')}}",
                data: data,
                dataType: "html",
                success: function (response) {
                    $('.load_classes').html(response);
                }
            });
            }
         
        });

        $('.funcionarioSearch').keyup(function(){
            var data = {
                search_text: $(this).val(),
                _token: "{{ csrf_token() }}"
            };
            $.ajax({
                type: "post",
                url: "{{route('getFuncionarios')}}",
                data: data,
                dataType: "html",
                success: function (response) {
                    $('.load_funcionarios').html(response);
                }
            });
        });

    });
</script>
@endsection