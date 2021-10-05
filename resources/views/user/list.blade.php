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
                                {{Form::text('text_search', null, ['class'=>"form-control text_seach", 'placeholder'=>"Pesquisar..."])}}
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
                                    <th>Nome do Funcionário</th>
                                    <th>Nome de Usuário</th>
                                    <th>Email</th>
                                    <th>Estado</th>
                                    <th>Nível de Acesso</th>

                                </tr>
                            </thead>
                            <tbody class="load_usuarios">
                                @if($getUsuarios->count()==0)
                                <span class="not_found">Nenhum usuário cadastrado</span>
                                @else
                                @foreach ($getUsuarios as $usuarios)

                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$usuarios->pessoa->nome}}</td>
                                    <td>{{$usuarios->username}}</td>
                                    <td>{{$usuarios->email}}</td>
                                    <td>{{$usuarios->estado}}</td>
                                    <td>{{$usuarios->nivel_acesso}}</td>

                                </tr>

                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>

                    <div class="pagination">
                        {{$getUsuarios->links()}}
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
		<a href="#" class="btn btn-primary btnCircular btnPrincipal" title="Novo"><i class="ti-plus"></i></a>
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
                url: "{{route('searchUsuarios')}}",
                data: data,
                dataType: "html",
                success: function (response) {
                    $('.load_usuarios').html(response);
                }
            });
        });

    });
</script>

@endsection
