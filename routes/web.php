<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "PrincipalController@index")->name('principal');
Route::get('/home', "HomeController@index")->name('home');
Route::get('/login', "UserController@loginForm")->name('login');
Route::post('/logar', "UserController@logar")->name('logar');
Route::get('/logout', "UserController@logout")->name('logout');

Route::group(['prefix' => 'ajax', 'middleware' => "auth"], function () {
    Route::post('/getClasses', "AjaxController@getClasses")->name('getClasses');
    Route::post('/getClasses2', "AjaxController@getClasses2")->name('getClasses2');
    Route::post('/getMunicipios', "AjaxController@getMunicipios")->name('getMunicipios');
    Route::post('/getTurmas', "AjaxController@getTurmas")->name('getTurmas');
    Route::post('/getEncarregados', "AjaxController@getEncarregados")->name('getEncarregados');
    Route::post('/getDisciplinas', "AjaxController@getDisciplinas")->name('getDisciplinas');
    Route::get('/addDisciplinas', "AjaxController@addDisciplinas")->name('addDisciplinas');
    Route::get('/getDisciplinasSelecionadas', "AjaxController@getDisciplinasSelecionadas")->name('getDisciplinasSelecionadas');
    Route::get('/removeDisciplinas', "AjaxController@removeDisciplinas")->name('removeDisciplinas');

    Route::post('/searchEstudantes', "AjaxController@searchEstudantes")->name('searchEstudantes');
    Route::post('/searchFuncionarios', "AjaxController@searchFuncionarios")->name('searchFuncionarios');
    Route::post('/searchEncarregados', "AjaxController@searchEncarregados")->name('searchEncarregados');
    Route::post('/getDisciplinasCad', "AjaxController@getDisciplinasCad")->name('getDisciplinasCad');
    Route::post('/getHoras', "AjaxController@getHoras")->name('getHoras');
    Route::post('/getFuncionarios', "AjaxController@getFuncionarios")->name('getFuncionarios');
    /*Route::post('/updateAvaliacao', "AjaxController@updateAvaliacao")->name('updateAvaliacao');
    Route::post('/updateProva', "AjaxController@updateProva")->name('updateProva');*/
    Route::post('/updateTrimestral', "AjaxController@updateTrimestral")->name('updatetrimestral');
    Route::post('/updateGlobal', "AjaxController@updateGlobal")->name('updateGlobal');
});

Route::group(['prefix' => 'institucional', 'middleware' => "auth"], function () {
    Route::group(['prefix' => 'cursos'], function () {
        Route::get('/', "InstitucionalController@curso_list");
        Route::get('/create', "InstitucionalController@curso_create");
        Route::post('/store', "InstitucionalController@curso_store");
        Route::get('/edit/{id}', "InstitucionalController@curso_edit");
        Route::put('/update/{id}', "InstitucionalController@curso_update");
    });

    Route::group(['prefix' => 'turmas',], function () {
        Route::get('/', "InstitucionalController@turma_list");
        Route::get('/create', "InstitucionalController@turma_create");
        Route::post('/store', "InstitucionalController@turma_store");
        Route::get('/edit/{id}', "InstitucionalController@turma_edit");
        Route::put('/update/{id}', "InstitucionalController@turma_update");
    });

    Route::group(['prefix' => 'disciplinas',], function () {
        Route::get('/', "InstitucionalController@disciplina_list");
        Route::get('/create', "InstitucionalController@disciplina_create");
        Route::post('/store', "InstitucionalController@disciplina_store");
        Route::get('/edit/{id}', "InstitucionalController@disciplina_edit");
        Route::put('/update/{id}', "InstitucionalController@disciplina_update");
    });

    Route::group(['prefix' => 'grades',], function () {
        Route::get('/', "InstitucionalController@grade_list");
        Route::get('/create', "InstitucionalController@grade_create");
        Route::post('/store', "InstitucionalController@grade_store");
        Route::get('/edit/{id}', "InstitucionalController@grade_edit");
        Route::put('/update/{id}', "InstitucionalController@grade_update");
    });

    Route::group(['prefix' => 'salas',], function () {
        Route::get('/', "InstitucionalController@sala_list");
        Route::get('/create', "InstitucionalController@sala_create");
        Route::post('/store', "InstitucionalController@sala_store");
        Route::get('/edit/{id}', "InstitucionalController@sala_edit");
        Route::put('/update/{id}', "InstitucionalController@sala_update");
    });

    Route::group(['prefix' => 'horas',], function () {
        Route::get('/', "InstitucionalController@hora_list");
        Route::get('/create', "InstitucionalController@hora_create");
        Route::post('/store', "InstitucionalController@hora_store");
        Route::get('/edit/{id}', "InstitucionalController@hora_edit");
        Route::put('/update/{id}', "InstitucionalController@hora_update");
    });

    Route::group(['prefix' => 'ano_lectivos',], function () {
        Route::get('/', "InstitucionalController@ano_lectivo_list");
        Route::get('/create', "InstitucionalController@ano_lectivo_create");
        Route::post('/store', "InstitucionalController@ano_lectivo_store");
        Route::get('/edit/{id}', "InstitucionalController@ano_lectivo_edit");
        Route::put('/update/{id}', "InstitucionalController@ano_lectivo_update");
    });

    Route::group(['prefix' => 'import',], function () {
        Route::get('/', "ImportController@index");
        Route::post('/store', "ImportController@store");
    });

    Route::group(['prefix' => "observacoes"], function () {
        Route::get('/', "InstitucionalController@observacoes");

        Route::group(['prefix' => "geral"], function () {
            Route::get('/', "InstitucionalController@geral_list");
            Route::get('/create', "InstitucionalController@geral_create");
            Route::post('/store', "InstitucionalController@geral_store");
        });

        Route::group(['prefix' =>"especifica"], function(){
            Route::get('/', "InstitucionalController@especifica_list");
            Route::get('/create', "InstitucionalController@especifica_create");
            Route::post('/store', "InstitucionalController@especifica_store");
        });
    });
});

Route::group(['prefix' => 'bloqueios', 'middleware' => "auth"], function () {
    Route::get('/', "BloqueioController@index");
    Route::get('/update/{id}', "BloqueioController@update");
});

Route::group(['prefix' => 'financas', 'middleware' => "auth"], function () {
    Route::group(['prefix' => 'tabela_precos'], function () {
        Route::get('/', "FinancaController@tabela_preco_list");
        Route::get('/create', "FinancaController@tabela_preco_create");
        Route::post('/store', "FinancaController@tabela_preco_store");
        Route::get('/edit/{id}', "FinancaController@tabela_preco_edit");
        Route::put('/update/{id}', "FinancaController@tabela_preco_update");
    });

    Route::group(['prefix' => 'tipo_pagamentos', 'middleware' => "auth"], function () {
        Route::get('/', "FinancaController@tipo_pagamento_list");
        Route::get('/create', "FinancaController@tipo_pagamento_create");
        Route::post('/store', "FinancaController@tipo_pagamento_store");
        Route::get('/edit/{id}', "FinancaController@tipo_pagamento_edit");
        Route::put('/update/{id}', "FinancaController@tipo_pagamento_update");
    });
});

Route::group(['prefix' => 'encarregados', 'middleware' => "auth"], function () {
    Route::get('/', "EncarregadoController@index");
    Route::get('/create', "EncarregadoController@create");
    Route::post('/store', "EncarregadoController@store");
    Route::get('/edit/{id}', "EncarregadoController@edit");
    Route::put('/update/{id}', "EncarregadoController@update");
});

Route::group(['prefix' => 'estudantes', 'middleware' => "auth"], function () {
    Route::get('/', "EstudanteController@index");
    Route::get('/create', "EstudanteController@create");
    Route::post('/store', "EstudanteController@store");
    Route::get('/edit/{id}', "EstudanteController@edit");
    Route::put('/update/{id}', "EstudanteController@update");
    Route::get('/confirmar/{id_estudantes}', "EstudanteController@confirmar");
    Route::put('/store_confirmar/{id_estudante}', "EstudanteController@store_confirmar");
    Route::get('/ficha/{id_estudante}/{ano_lectivo}', "EstudanteController@ficha");
    Route::get('/declaracao/{id_estudante}/{ano_lectivo}', "EstudanteController@declaracao");
    Route::put('/store_declaracao/{id_estudante}', "EstudanteController@store_declaracao");
});

Route::group(['prefix' => 'pagamentos', 'middleware' => "auth"], function () {
    Route::get('/listar/{id_estudante}/{ano_lectivo}', "PagamentoController@listar");
    Route::get('/create/{id_tipo_pagamento}', "PagamentoController@create");
    Route::post('/store', "PagamentoController@store");
    Route::post('/show', "PagamentoController@show")->name('show_pagamento');
});

Route::group(['prefix' => 'funcionarios', 'middleware' => "auth"], function () {
    Route::get('/', "FuncionarioController@index");
    Route::get('/create', "FuncionarioController@create");
    Route::post('/store', "FuncionarioController@store");
    Route::get('/edit/{id}', "FuncionarioController@edit");
    Route::put('/update/{id}', "FuncionarioController@update");
});

Route::group(['prefix' => 'directores', 'middleware' => "auth"], function () {
    Route::get('/', "DirectorTurmaController@index");
    Route::get('/create', "DirectorTurmaController@create");
    Route::post('/store', "DirectorTurmaController@store");
    Route::get('/edit/{id}', "DirectorTurmaController@edit");
    Route::put('/update/{id}', "DirectorTurmaController@update");
});

Route::group(['prefix' => "horarios", 'middleware' => "auth"], function () {
    Route::get('/create/{id_funcionario}', "HorarioController@create");
    Route::put('/store/{id_funcionario}', "HorarioController@store");
});

Route::group(['prefix' => 'estatisticas', 'middleware' => "auth"], function () {
    Route::group(['prefix' => 'pagamentos', 'middleware' => "AdminUser"], function () {
        Route::get('/', "EstatisticaController@lista_pagamento");
    });

    Route::group(['prefix' => 'balancos', 'middleware' => "admin"], function () {
        Route::get('/list/{ano}', "EstatisticaController@balanco");
    });

    Route::group(['prefix' => "minipautas", 'middleware' => "prof"], function () {
        Route::get('/list/{id_turma}/{id_disciplina}/{ano_lectivo}', "EstatisticaController@minipauta");
    });
});

Route::group(['prefix' => 'relatorios', 'middleware' => "auth"], function () {
    Route::get('/fatura/{id_fatura}', "RelatorioController@fatura");
    Route::get('/lista_pagamentos', "RelatorioController@lista_pagamentos");
    Route::get('/lista_comparticicacao', "RelatorioController@lista_comparticipacao");
    Route::get('/lista_nominal', "RelatorioController@lista_nominal");
});

/*Route::group(['prefix' => 'cadernetas', 'middleware' => "auth"], function () {
    Route::get('/', "CadernetaController@index");
    Route::get('/print/{id_turma}/{id_disciplina}/{ano_lectivo}', "ExportController@minipauta");
    Route::get('/create/{id_turma}/{id_disciplina}/{ano_lectivo}/{epoca}', "CadernetaController@create");
    Route::get('/store/{id_turma}/{id_disciplina}/{ano_lectivo}', "CadernetaController@store");
    Route::get('/store_copy/{id_turma}/{id_disciplina}/{epoca}/{ano_lectivo}', "CadernetaController@store_copy");
});*/

Route::group(['prefix' => 'cadernetas', 'middleware' => "auth"], function () {
    Route::get('/', "CadernetaController_copy@index");
    Route::get('/print/{id_turma}/{id_disciplina}/{ano_lectivo}', "ExportController@minipauta");
    Route::get('/create/{id_turma}/{id_disciplina}/{ano_lectivo}/{epoca}', "CadernetaController_copy@create");
    Route::get('/store/{id_turma}/{id_disciplina}/{ano_lectivo}', "CadernetaController_copy@store");
    Route::get('/store_copy/{id_turma}/{id_disciplina}/{epoca}/{ano_lectivo}', "CadernetaController_copy@store_copy");
});

Route::group(['prefix' => 'minipautas', 'middleware' => "auth"], function () {
    Route::get('/show/{id_turma}/{id_disciplina}/{ano_lectivo}', "MiniPautaController@show");
});


Route::group(['prefix' => 'minha_turma', 'middleware' => "auth"], function () {
    Route::get('/', "MinhaTurmaController@index");
    Route::get('/horario/{id_turma}/{ano_lectivo}', "MinhaTurmaController@horario");
});

Route::group(['prefix' => 'pautas', 'middleware' => "auth"], function () {
    Route::get('/create/{id_turma}/{ano_lectivo}', "PautaController@create");
    Route::put('/show/{id_turma}/{ano_lectivo}', "PautaController@show");

    Route::get('/exports/{id_turma}/{ano_lectivo}', "ExportController@pauta");
});

Route::group(['prefix' => 'usuarios', 'middleware' => "AdminUser"], function () {
    Route::get('/', "UserController@index");
});