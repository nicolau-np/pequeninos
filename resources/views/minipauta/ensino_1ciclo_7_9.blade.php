@extends('layouts.app')
@section('content')
<style>
    .notaP, .notaA{
        width: 70px;
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
                       <div class="tabela">
                           <table class="table table-bordered table-striped">
                              <thead>
                                  <tr>
                                      <th>Nº</th>
                                      <th>Nome do Estudante</th>
                                      <th>Gênero</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($getHistorico as $historico)
                                  <tr>
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{$historico->estudante->pessoa->nome}}</td>
                                  <td>{{$historico->estudante->pessoa->genero}}</td>
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