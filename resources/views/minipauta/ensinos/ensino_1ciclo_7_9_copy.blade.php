@php
use App\Http\Controllers\ControladorNotas;
@endphp
@extends('layouts.app')
@section('content')
<style>
    .positivo{
        color: #4680ff;
    }
    .negativo{
        color: red;
    }
    .nenhum{
        color: #333;
    }
    .tabela{
        font-size: 12px;
    }
    table thead{
        background-color: #4680ff;
        color: #fff;
    }
    table thead th{
        font-weight: normal;
    }
</style>
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{$submenu}}
                    <i class="ti-angle-right"></i>
                    {{$getHorario->turma->turma}}
                    <i class="ti-angle-right"></i>
                    {{$getHorario->disciplina->disciplina}}
                    <i class="ti-angle-right"></i>
                    {{$getHorario->ano_lectivo}}
                    </h5>
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
                    <div class="row">
                       <div class="col-lg-12 col-xl-12">
                       <div class="table-responsive tabela">
                           <table class="table table-bordered table-striped">
                              <thead>
                                  <tr>
                                      <th rowspan="2">Nº</th>
                                      <th rowspan="2">NOME COMPLETO</th>
                                      <th rowspan="2">G</th>
                                      <th colspan="4">1º Trimestre</th>
                                      <th colspan="4">2º Trimestre</th>
                                      <th colspan="4">3º Trimestre</th>
                                      <th colspan="2">-</th>
                                  </tr>
                                  <tr>
                                      <th>MAC1</th>
                                      <th>NPP1</th>
                                      <th>PT1</th>
                                      <th>MT1</th>

                                      <th>MAC2</th>
                                      <th>NPP2</th>
                                      <th>PT2</th>
                                      <th>MT2</th>

                                      <th>MAC3</th>
                                      <th>NPP3</th>
                                      <th>PT3</th>
                                      <th>MT3</th>

                                      <th>MFD</th>
                                      <th>MF</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($getHistorico as $historico)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$historico->estudante->pessoa->nome}}</td>
                                    <td>{{$historico->estudante->pessoa->genero}}</td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
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
		<a href="/cadernetas/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>

@endsection
