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
                        {{Form::open(['method'=>"post", 'url'=>"/usuarios/store"])}}
                        @csrf
                        <fieldset>
                            <legend><i class="ti-list"></i> Dados pessoais</legend>
                            <div class="row">

                                <div class="col-md-4">
                                    {{Form::label('nome', "Nome completo")}} <span class="text-danger">*</span>
                                    {{Form::text('nome', null, ['class'=>"form-control", 'placeholder'=>"Nome completo"])}}
                                    <div class="erro">
                                        @if($errors->has('nome'))
                                        <div class="text-danger">{{$errors->first('nome')}}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    {{Form::label('genero', "Gênero")}} <span class="text-danger">*</span>
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
                                    {{Form::label('provincia', "Provincia")}} <span class="text-danger">*</span>
                                    {{Form::select('provincia', $getProvincias, null, ['class'=>"form-control provincia", 'placeholder'=>"Província"])}}

                                <div class="erro">
                                    @if($errors->has('provincia'))
                                    <div class="text-danger">{{$errors->first('provincia')}}</div>
                                    @endif
                                </div>
                                </div>


                                <div class="col-md-3">
                                    {{Form::label('municipio', "Município")}} <span class="text-danger">*</span>
                                    <span class="load_municipios">
                                    {{Form::select('municipio', [], null, ['class'=>"form-control", 'placeholder'=>"Município"])}}
                                </span>
                                <div class="erro">
                                    @if($errors->has('municipio'))
                                    <div class="text-danger">{{$errors->first('municipio')}}</div>
                                    @endif
                                </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('naturalidade', "Naturalidade")}}
                                    {{Form::text('naturalidade', null, ['class'=>"form-control", 'placeholder'=>"Naturalidade"])}}
                                    <div class="erro">
                                        @if($errors->has('naturalidade'))
                                        <div class="text-danger">{{$errors->first('naturalidade')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('comuna', "Comuna")}}
                                    {{Form::text('comuna', null, ['class'=>"form-control", 'placeholder'=>"Comuna"])}}
                                    <div class="erro">
                                        @if($errors->has('comuna'))
                                        <div class="text-danger">{{$errors->first('comuna')}}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    {{Form::label('data_nascimento', "Data de Nascimento")}} <span class="text-danger">*</span>
                                    {{Form::date('data_nascimento', null, ['class'=>"form-control", 'placeholder'=>"Data de Nascimento"])}}
                                    <div class="erro">
                                        @if($errors->has('data_nascimento'))
                                        <div class="text-danger">{{$errors->first('data_nascimento')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('estado_civil', "Estado Civíl")}}
                                    {{Form::select('estado_civil', [
                                        'Solteiro(a)'=>"Solteiro(a)",
                                        'Casado(a)'=>"Casado(a)",
                                    ], null, ['class'=>"form-control", 'placeholder'=>"Estado Civíl"])}}

                                <div class="erro">
                                    @if($errors->has('estado_civil'))
                                    <div class="text-danger">{{$errors->first('estado_civil')}}</div>
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

                                <div class="col-md-3">
                                    {{Form::label('bilhete', "Bilhete")}}
                                    {{Form::text('bilhete', null, ['class'=>"form-control", 'placeholder'=>"Bilhete"])}}
                                    <div class="erro">
                                        @if($errors->has('bilhete'))
                                        <div class="text-danger">{{$errors->first('bilhete')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('local_emissao', "Local de Emissão")}}
                                    {{Form::text('local_emissao', null, ['class'=>"form-control", 'placeholder'=>"Local de Emissão"])}}
                                    <div class="erro">
                                        @if($errors->has('local_emissao'))
                                        <div class="text-danger">{{$errors->first('local_emissao')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('data_emissao', "Data de Emissão")}}
                                    {{Form::date('data_emissao', null, ['class'=>"form-control", 'placeholder'=>"Data de Emissão"])}}
                                    <div class="erro">
                                        @if($errors->has('data_emissao'))
                                        <div class="text-danger">{{$errors->first('data_emissao')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('pai', "Pai")}}
                                    {{Form::text('pai', null, ['class'=>"form-control", 'placeholder'=>"Pai"])}}
                                    <div class="erro">
                                        @if($errors->has('pai'))
                                        <div class="text-danger">{{$errors->first('pai')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('mae', "Mãe")}}
                                    {{Form::text('mae', null, ['class'=>"form-control", 'placeholder'=>"Mãe"])}}
                                    <div class="erro">
                                        @if($errors->has('mae'))
                                        <div class="text-danger">{{$errors->first('mae')}}</div>
                                        @endif
                                    </div>
                                </div>

                            </div>

                        </fieldset>
                        <br/>
                        <fieldset>
                            <legend><i class="ti-list"></i> Dados do Usuário</legend>
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('email', "E-mail")}} <span class="text-danger">*</span>
                                    {{Form::email('email', null, ['class'=>"form-control", 'placeholder'=>"E-mail"])}}
                                <div class="erro">
                                    @if($errors->has('email'))
                                    <div class="text-danger">{{$errors->first('email')}}</div>
                                    @endif
                                </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('nivel_acesso', "Nível de Acesso")}} <span class="text-danger">*</span>
                                    {{Form::select('nivel_acesso', [
                                        'master'=>"master",
                                        'admin'=>"admin",
                                        'user'=>"user",
                                        'super'=>"super",
                                    ], null, ['class'=>"form-control", 'placeholder'=>"Nível de Acesso"])}}
                                <div class="erro">
                                    @if($errors->has('nivel_acesso'))
                                    <div class="text-danger">{{$errors->first('nivel_acesso')}}</div>
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
		<a href="/usuarios/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>
<script>
    $(document).ready(function(){
        $('.provincia').change(function(e){
            e.preventDefault();
            var data = {
                id_provincia: $(this).val(),
                _token: "{{ csrf_token() }}"
            };
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
