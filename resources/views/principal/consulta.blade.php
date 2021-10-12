@extends('layouts.app_principal')
@section('content')

<section id="about" class="site-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="text-align: center;">
                <div class="form">
                    @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    {{Form::open(['class'=>"form_consulta", 'method'=>"post", 'url'=>"/consultar"])}}
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                {{Form::label('codigo_acesso', "Código de Acesso")}}
                                {{Form::text('codigo_acesso', null, ['class'=>"form-control", 'placeholder'=>"Código de Acesso"])}}
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
