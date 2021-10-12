@extends('layouts.app_principal')
@section('content')

<section id="dados" class="site-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-9" style="font-size:20px;">
                <fieldset>
                    <legend>Dados Estudante</legend>
                    <b>Nome Completo:</b> {{$getEstudante->pessoa->nome}}<br/>
                    <b>Turma:</b> {{$getEstudante->turma->turma}}&nbsp;&nbsp;
                    <b>Classe:</b> {{$getEstudante->turma->classe->classe}}&nbsp;&nbsp;
                    <b>Turno:</b> {{$getEstudante->turma->turno->turno}}&nbsp;&nbsp;
                    <b>Ano Lectivo:</b> {{$getEstudante->ano_lectivo}}&nbsp;&nbsp;
                </fieldset>
            </div>
            <div class="col-md-3" style="font-size:20px;">
                <img src="
                            @if ($getEstudante->pessoa->foto)
                            {{asset($getEstudante->pessoa->foto)}}
                            @else
                            {{asset('assets/template/images/profile.png')}}
                            @endif

                            " alt="" style="width:100%; height:28vh; border-radius: 5px;"/>
            </div>
        </div>

        <div class="row">
            
        </div>
    </div>
</section>


@endsection
