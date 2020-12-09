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
                        {{Form::open(['method'=>"post", 'url'=>"/institucional/grades/store"])}}
                        @csrf
                        <fieldset>
                            <legend><i class="ti-list"></i> Dados da Grade Curricular</legend>
                            <div class="row">
                                <div class="col-md-12">
                                    {{Form::label('disciplina', "Disciplina")}}
                                    {{Form::text('disciplina', null, ['class'=>"form-control disciplina", 'placeholder'=>"Pesquisar disciplina"])}}
                                    <div class="erro">
                                        @if($errors->has('disciplina'))
                                        <div class="text-danger">{{$errors->first('disciplina')}}</div>
                                        @endif 
                                    </div>
                                    <hr/>
                                </div>
                                
                                <div class="col-md-6">
                                    {{Form::submit('Salvar', ['class'=>"btn btn-primary btn-sm float-left"])}}
                                     
                                    <a href="#" class="btn btn-danger btn-sm float-right remover_todas"><i class="ti-trash" aria-hidden="true"></i></a>
                                   <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Disciplina</th>
                                            <th>Sígla</th>
                                            <th>Operações</th>
                                        </tr>
                                    </thead>
                                    <tbody class="load_disciplina">
                                        <tr>
                                            <td scope="row"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                     </tbody>
                                </table>
                                </div>
                                <div class="col-md-6 load_selected">
                                  Nenhuma selecionada
                                </div>
                            </div>
                            <br/>
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
<div class="btnPesquisar">
	<div class="btnPesquisarBtn">
		<a href="/institucional/grades/" class="btn btn-primary btnCircular btnPrincipal" title="Listar"><i class="ti-search"></i></a>
	</div>
</div>
<script>
    $(document).ready(function(){
        disciplinas();

        $('.disciplina').keyup(function(){
            var data = {
                search_text: $(this).val(),
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                type: "post",
                url: "{{route('getDisciplinas')}}",
                data: data,
                dataType: "html",
                success: function (response) {
                    $('.load_disciplina').html(response);
                }
            });
        });

        function disciplinas(){
            $.ajax({
                type: "get",
                url: "{{route('getDisciplinasSelecionadas')}}",
                data: null,
                dataType: "html",
                success: function (response) {
                    $('.load_selected').html(response);
                }
            });
        }

        $('.remover_todas').click(function(e){
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "{{route('removeDisciplinas')}}",
                data: null,
                dataType: "json",
                success: function (response) {
                    if(response.status === "ok"){
                        disciplinas();
                    }else if(response.status === "error"){
                        disciplinas();
                    }
                  
                }
            });
        });
 
    });
</script>
@endsection