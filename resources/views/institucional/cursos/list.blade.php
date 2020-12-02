@extends('layouts.app')
@section('content')
<style>
 /* Botão pesquisar e Mais Botões */
.btnPesquisar{
	position: fixed;
	float: bottom;
	bottom: 15px;
	right: 15px;
	z-index: 100;
}


.btnPesquisarBtn {
	display: inline-block;
}

.btnCircular{
	border-radius: 50%;
    
}

.btnPrincipal{
	font-size: 20px;
	padding: 12px;
    text-align: center;
    font-weight: bold;
    box-shadow: 2px 4px 47px -4px rgba(0,0,0,0.82);
}

.btnPrincipal:hover{
	background-color: #aacc77;
    border:0px;
}
.text-right{
    float: right;
}


.pagination{
    text-align: center;
}
</style>
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
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                    <th>Operações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>
                                        <a href="http://" class="btn btn-primary btn-sm"><i class="ti-pencil-alt"></i> Editar</a>
                                        <a href="http://" class="btn btn-danger btn-sm"><i class="ti-trash"></i> Eliminar</a>
                                    </td>
                                </tr>
                             
                             
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination">

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
		<a href="/institucional/cursos/create" class="btn btn-primary btnCircular btnPrincipal" title="Novo"><i class="ti-plus"></i></a>
	</div>
</div>


@endsection