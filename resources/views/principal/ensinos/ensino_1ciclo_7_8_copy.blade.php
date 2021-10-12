@php
use App\Http\Controllers\ControladorNotas;
@endphp
@extends('layouts.app_principal')
@section('content')
<style>
     .positivo{
        color: #4680ff;
        font-weight: bold;
    }
    .negativo{
        color: #FC6180;
        font-weight: bold;
    }
    .nenhum{
        color: #333;
        font-weight: bold;
    }
</style>
<section id="dados" class="site-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-9" style="font-size:18px;">
                <fieldset>
                    <legend>Dados Estudante</legend>
                    <b>Nome Completo:</b> {{$getEstudante->pessoa->nome}}<br/>
                    <b>Turma:</b> {{$getEstudante->turma->turma}} [ {{$getEstudante->turma->turno->turno}} ]<br/>
                    <b>Classe:</b> {{$getEstudante->turma->classe->classe}}<br/>
                    <b>Ano Lectivo:</b> {{$getEstudante->ano_lectivo}}<br/>
                </fieldset>
            </div>
            <div class="col-md-3">
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
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2">DISCIPLINA</th>
                                    <th colspan="4">1º TRIMESTRE</th>
                                    <th colspan="4">2º TRIMESTRE</th>
                                    <th colspan="4">3º TRIMESTRE</th>
                                </tr>
                                <tr>
                                    <th>MAC</th>
                                    <th>NPP</th>
                                    <th>PT</th>
                                    <th>MT</th>

                                    <th>MAC</th>
                                    <th>NPP</th>
                                    <th>PT</th>
                                    <th>MT</th>

                                    <th>MAC</th>
                                    <th>NPP</th>
                                    <th>PT</th>
                                    <th>MT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getGrades as $grades)

                                 <tr>
                                    <td>{{$grades->disciplina->disciplina}}</td>
                                    @php
                                    $trimestre1 = ControladorNotas::getValoresMiniPautaTrimestralPDF($grades->id_disciplina, $getEstudante->id, 1, $getEstudante->ano_lectivo);
                                    @endphp
                                    @if ($trimestre1->count()==0)
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                        <td>---</td>
                                    @else
                                        @foreach ($trimestre1 as $valor1)
                                        @php
                                            $v1_estilo = ControladorNotas::nota_20($valor1->mac);
                                            $v2_estilo = ControladorNotas::nota_20($valor1->npp);
                                            $v3_estilo = ControladorNotas::nota_20($valor1->pt);
                                            $v4_estilo = ControladorNotas::nota_20($valor1->mt);
                                        @endphp
                                        <td class="{{$v1_estilo}}">@if($valor1->mac==null) --- @else {{round($valor1->mac,2)}} @endif</td>
                                        <td class="{{$v2_estilo}}">@if($valor1->npp==null) --- @else {{round($valor1->npp,2)}} @endif</td>
                                        <td class="{{$v3_estilo}}">@if($valor1->pt==null) --- @else {{round($valor1->pt,2)}} @endif</td>
                                        <td class="{{$v4_estilo}}">@if($valor1->mt==null) --- @else {{round($valor1->mt,2)}} @endif</td>
                                        @endforeach
                                    @endif


                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </fieldset>
            </div>
        </div>
    </div>
</section>


@endsection
