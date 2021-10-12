@extends('layouts.app_principal')
@section('content')

<section id="dados" class="site-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-9" style="font-size:20px;">
                <fieldset>
                    <legend>Dados Estudante</legend>
                    <b>Nome Completo:</b> {{$getEstudante->pessoa->nome}}<br/>
                    <b>Turma:</b> {{$getEstudante->turma->turma}} [ {{$getEstudante->turma->turno->turno}} ]<br/>
                    <b>Classe:</b> {{$getEstudante->turma->classe->classe}}<br/>
                    <b>Ano Lectivo:</b> {{$getEstudante->ano_lectivo}}<br/>
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
           <div class="col-md-12">
            <fieldset>
                <legend>Aproveitamento e Notas</legend>
            </fieldset>
            </div>
        </div>
    </div>
</section>


@endsection
