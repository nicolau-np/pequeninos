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
                        {{Form::open(['method'=>"get", 'url'=>"/estatisticas/balancos/grafico"])}}
                        <fieldset>
                            <legend><i class="ti-search"></i> Dados da pesquisa</legend>
 
                            <div class="row">
                                <div class="col-md-3">
                                    {{Form::label('forma_pagamento', "Forma de Pagamento")}} <span class="text-danger">*</span>
                                    {{Form::select('forma_pagamento', [
                                        'Trimestral'=>"Trimestral",
                                        'Mensal'=>"Mensal",
                                        'Anual'=>"Anual"
                                    ], null, ['class'=>"form-control", 'placeholder'=>"Forma de Pagamento"])}}
                                
                                <div class="erro">
                                    @if($errors->has('forma_pagamento'))
                                    <div class="text-danger">{{$errors->first('forma_pagamento')}}</div>
                                    @endif 
                                </div>
                                </div>

                             <div class="col-md-2">
                                 {{Form::label('ano_lectivo', "Ano Lectivo")}} <span class="text-danger">*</span>
                                 {{Form::number('ano_lectivo', null, ['class'=>"form-control", 'placeholder'=>"Ano Lectivo"])}}
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


@endsection