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
                        {{Form::open(['method'=>"put", 'url'=>"/financas/tabela_precos/update/{$getTabela_preco->id}"])}}
                        @csrf
                        <fieldset>
                            <legend><i class="ti-list"></i> Dados do preço</legend>
                            <div class="row">

                                <div class="col-md-3">
                                    {{Form::label('tipo_pagamento', "Pagamento")}} <span class="text-danger">*</span>
                                    {{Form::select('tipo_pagamento', $getTipoPagamentos, $getTabela_preco->id_tipo_pagamento, ['class'=>"form-control", 'placeholder'=>"Pagamento"])}}

                                <div class="erro">
                                    @if($errors->has('tipo_pagamento'))
                                    <div class="text-danger">{{$errors->first('tipo_pagamento')}}</div>
                                    @endif
                                </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('forma_pagamento', "Forma de Pagamento")}} <span class="text-danger">*</span>
                                    {{Form::select('forma_pagamento', [
                                        'Trimestral'=>"Trimestral",
                                        'Mensal'=>"Mensal",
                                        'Anual'=>"Anual"
                                    ], $getTabela_preco->forma_pagamento, ['class'=>"form-control", 'placeholder'=>"Forma de Pagamento"])}}

                                <div class="erro">
                                    @if($errors->has('forma_pagamento'))
                                    <div class="text-danger">{{$errors->first('forma_pagamento')}}</div>
                                    @endif
                                </div>
                                </div>

                                <div class="col-md-3">
                                    {{Form::label('curso', "Curso")}} <span class="text-danger">*</span>
                                    {{Form::select('curso', $getCursos, $getTabela_preco->id_curso, ['class'=>"form-control curso", 'placeholder'=>"Curso"])}}
                                <div class="erro">
                                    @if($errors->has('curso'))
                                    <div class="text-danger">{{$errors->first('curso')}}</div>
                                    @endif
                                </div>
                                </div>

                                <div class="col-md-2">
                                    {{Form::label('classe', "Classe")}} <span class="text-danger">*</span>
                                    <span class="load_classes">
                                    {{Form::select('classe', [
                                        $getTabela_preco->id_classe=>$getTabela_preco->classe->classe
                                    ], $getTabela_preco->id_classe, ['class'=>"form-control", 'placeholder'=>"Classe"])}}
                                </span>
                                <div class="erro">
                                    @if($errors->has('classe'))
                                    <div class="text-danger">{{$errors->first('classe')}}</div>
                                    @endif
                                </div>
                                </div>

                                <div class="col-md-2">
                                    {{Form::label('preco', "Preço (Akz)")}} <span class="text-danger">*</span>
                                    {{Form::number('preco', number_format($getTabela_preco->preco,0,'',''), ['class'=>"form-control", 'placeholder'=>"Preço"])}}
                                    <div class="erro">
                                        @if($errors->has('preco'))
                                        <div class="text-danger">{{$errors->first('preco')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    {{Form::label('percentagem_multa', "% Multa")}}
                                    {{Form::number('percentagem_multa', $getTabela_preco->percentagem_multa, ['class'=>"form-control", 'placeholder'=>"% Multa"])}}
                                    <div class="erro">
                                        @if($errors->has('percentagem_multa'))
                                        <div class="text-danger">{{$errors->first('percentagem_multa')}}</div>
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
		<a href="/financas/tabela_precos/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>

<script>
    $(document).ready(function(){
        $('.curso').change(function(e){
            e.preventDefault();
            var data = {
                id_curso: $(this).val(),
                _token: "{{ csrf_token() }}"
            }
            $.ajax({
                type: "post",
                url: "{{route('getClasses')}}",
                data: data,
                dataType: "html",
                success: function (response) {
                    $('.load_classes').html(response);
                }
            });
        });
    });
</script>
@endsection
