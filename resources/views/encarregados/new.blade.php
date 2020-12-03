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
                        {{Form::open(['method'=>"post", 'url'=>"/encarregados/store"])}}
                        @csrf
                        <fieldset>
                            <legend><i class="ti-list"></i> Dados do encarregado</legend>
                            <div class="row">

                                <div class="col-md-4">
                                    {{Form::label('nome', "Nome completo")}}
                                    {{Form::text('nome', null, ['class'=>"form-control", 'placeholder'=>"Nome completo"])}}
                                    <div class="erro">
                                        @if($errors->has('nome'))
                                        <div class="text-danger">{{$errors->first('nome')}}</div>
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('provincia', "Provincia")}}
                                    {{Form::select('provincia', $getProvincias, null, ['class'=>"form-control provincia", 'placeholder'=>"Província"])}}
                                
                                <div class="erro">
                                    @if($errors->has('provincia'))
                                    <div class="text-danger">{{$errors->first('provincia')}}</div>
                                    @endif 
                                </div>
                                </div>


                                <div class="col-md-3">
                                    {{Form::label('municipio', "Município")}}
                                    <span class="load_municipios">
                                    {{Form::select('municipio', [], null, ['class'=>"form-control", 'placeholder'=>"Município"])}}
                                </span>
                                <div class="erro">
                                    @if($errors->has('municipio'))
                                    <div class="text-danger">{{$errors->first('municipio')}}</div>
                                    @endif 
                                </div>
                                </div>

                                <div class="col-md-2">
                                    {{Form::label('genero', "Gênero")}}
                                    {{Form::select('genero', [
                                        'M'=>"M",
                                        'F'=>"F"
                                    ], null, ['class'=>"form-control", 'placeholder'=>"Gênero"])}}
                                
                                <div class="erro">
                                    @if($errors->has('genero'))
                                    <div class="text-danger">{{$errors->first('genero')}}</div>
                                    @endif 
                                </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('telefone', "Telefone")}}
                                    {{Form::number('telefone', null, ['class'=>"form-control", 'placeholder'=>"Telefone"])}}
                                    <div class="erro">
                                        @if($errors->has('telefone'))
                                        <div class="text-danger">{{$errors->first('telefone')}}</div>
                                        @endif 
                                    </div>
                                </div>
                            </div>
                            <br/>
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
		<a href="/encarregados/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>

<script>
    $(document).ready(function(){
        $('.provincia').change(function(e){
            e.preventDefault();
            var data = {
                id_provincia: $(this).val(),
                _token: "{{ csrf_token() }}"
            }
            $.ajax({
                type: "post",
                url: "{{route('getMunicipios')}}",
                data: data,
                dataType: "html",
                success: function (response) {
                    $('.load_municipios').html(response);
                }
            });
        });
    });
</script>
@endsection