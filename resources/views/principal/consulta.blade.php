@extends('layouts.app_principal')
@section('content')

<section id="consulta" class="site-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form">
                    @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    {{Form::open(['class'=>"form_consulta", 'method'=>"get", 'url'=>"/consultar/dados"])}}
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                {{Form::label('codigo_acesso', "Código de Acesso")}}
                                {{Form::text('codigo_acesso', null, ['class'=>"form-control", 'placeholder'=>"Código de Acesso"])}}
                                <span class="text-danger">
                                    @if($errors->has('codigo_acesso'))
                                    <div class="text-danger">{{$errors->first('codigo_acesso')}}</div>
                                    @endif
                                </span>
                           </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4" style="margin-top:4px;">
                                {{Form::submit('CONSULTAR', ['class'=>"btn btn-primary",])}}
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
