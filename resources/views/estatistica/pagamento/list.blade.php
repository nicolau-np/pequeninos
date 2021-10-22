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
                    @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                       {{Form::open(['method'=>"get", 'url'=>"/relatorios/lista_pagamentos/"])}}
                       <fieldset>
                           <legend><i class="ti-search"></i> Dados da pesquisa</legend>

                           <div class="row">

                            <div class="col-md-3">
                                {{Form::label('tipo_pagamento', "Pagamento")}} <span class="text-danger">*</span>
                                {{Form::select('tipo_pagamento', $getTipoPagamentos, null, ['class'=>"form-control", 'placeholder'=>"Pagamento"])}}

                            <div class="erro">
                                @if($errors->has('tipo_pagamento'))
                                <div class="text-danger">{{$errors->first('tipo_pagamento')}}</div>
                                @endif
                            </div>
                            </div>

                            <div class="col-md-2">
                                {{Form::label('curso', "Curso")}} <span class="text-danger">*</span>
                                {{Form::select('curso', $getCursos, null, ['class'=>"form-control curso", 'placeholder'=>"Curso"])}}
                            <div class="erro">
                                @if($errors->has('curso'))
                                <div class="text-danger">{{$errors->first('curso')}}</div>
                                @endif
                            </div>
                            </div>

                            <div class="col-md-2">
                                {{Form::label('classe', "Classe")}} <span class="text-danger">*</span>
                                <span class="load_classes">
                                {{Form::select('classe', [], null, ['class'=>"form-control", 'placeholder'=>"Classe"])}}
                            </span>
                            <div class="erro">
                                @if($errors->has('classe'))
                                <div class="text-danger">{{$errors->first('classe')}}</div>
                                @endif
                            </div>
                            </div>

                            <div class="col-md-2">
                                {{Form::label('turma', "Turma")}} <span class="text-danger">*</span>
                                <span class="load_turmas">
                                {{Form::select('turma', [], null, ['class'=>"form-control", 'placeholder'=>"Turma"])}}
                            </span>
                            <div class="erro">
                                @if($errors->has('turma'))
                                <div class="text-danger">{{$errors->first('turma')}}</div>
                                @endif
                            </div>
                            </div>

                            <div class="col-md-2">
                                {{Form::label('ano_lectivo', "Ano Lectivo")}} <span class="text-danger">*</span>
                                {{Form::select('ano_lectivo', $getAnoLectivos, null, ['class'=>"form-control",])}}
                                <div class="erro">
                                    @if($errors->has('ano_lectivo'))
                                    <div class="text-danger">{{$errors->first('ano_lectivo')}}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-1">
                                <button type="submit" class="btn btn-success btn-sm" style="position: absolute; top:29px; left:10px;"><i class="ti-search"></i></button>
                            </div>
                        </div>
                        </fieldset>

                       {{Form::close()}}
                   </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- hidden-sm-up -->

<!-- botão pesquisar -->

<script>
    $(document).ready(function(){
        $('.curso').change(function(e){
            e.preventDefault();
            var data = {
                id_curso: $(this).val(),
                _token: "{{ csrf_token() }}"
            }
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
    });
</script>
@endsection
