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
                        {{Form::open(['class'=>"form_search", 'method'=>"post", 'url'=>"#"])}}
                        <div class="row text-right">
                            <div class="col-md-8">
                                {{Form::text('text_search', null, ['class'=>"form-control text_search", 'placeholder'=>"Pesquisar..."])}}
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-success btn-sm"><i class="ti-search"></i></button>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                    
                    <div class="table-responsive">
                        <br/>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Provincia</th>
                                    <th>Muncipio</th>
                                    <th>Telefone</th>
                                    <th>Operações</th>
                                </tr>
                            </thead>
                            <tbody class="load_encarregados">
                                @if($getEncarregados->count()==0)
                                <span class="not_found">Nenhum encarregado cadastrado</span>
                                @else
                                @foreach ($getEncarregados as $encarregados)
                                    
                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$encarregados->pessoa->nome}}</td>
                                    <td>{{$encarregados->pessoa->municipio->provincia->provincia}}</td>
                                    <td>{{$encarregados->pessoa->municipio->municipio}}</td>
                                    <td>{{$encarregados->pessoa->telefone}}</td>
                                    <td>
                                        <a href="/encarregados/edit/{{$encarregados->id}}" class="btn btn-primary btn-sm"><i class="ti-pencil-alt"></i> Editar</a>
                                        <a href="http://" class="btn btn-danger btn-sm"><i class="ti-trash"></i> Eliminar</a>
                                    </td>
                                </tr>

                                @endforeach
                                @endif
                             
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination">
                        {{$getEncarregados->links()}}
                    </div>

                    <div class="pesquisa_avancada">
                       <div class="form">
                        @if(session('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                        @endif
    
                        @if(session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                        @endif

                           {{Form::open(['method'=>"get", 'url'=>"/relatorios/lista_comparticicacao",])}}
                            <fieldset>
                                <legend>
                                    <i class="ti-search"></i> Lista de Comparticipação
                                </legend>
                                <div class="row">
                                    <div class="col-md-3">
                                        {{ Form::select('ano_lectivo', $getAnos, null, ['placeholder'=>"Ano Lectivo", 'class'=>"form-control"]) }}
                                        <div class="erro">
                                            @if($errors->has('ano_lectivo'))
                                            <div class="text-danger">{{$errors->first('ano_lectivo')}}</div>
                                            @endif 
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::submit('Pesquisar', ['class'=>"btn btn-primary"])}}
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
    
</div>

<!-- hidden-sm-up -->

<!-- botão pesquisar -->
<div class="btnPesquisar">
	<div class="btnPesquisarBtn">
		<a href="/encarregados/create" class="btn btn-primary btnCircular btnPrincipal" title="Novo"><i class="ti-plus"></i></a>
	</div>
</div>


<script>
    $(document).ready(function(){
        $('.text_search').keyup(function(e){
            e.preventDefault();
            var data = {
                search_text: $(this).val(),
                _token: "{{ csrf_token() }}" 
            };
            $.ajax({
                type: "post",
                url: "{{route('searchEncarregados')}}",
                data: data,
                dataType: "html",
                success: function (response) {
                    $('.load_encarregados').html(response);
                }
            });
        });
    });
</script>

@endsection