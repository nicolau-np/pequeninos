<?php

use App\RestricaoNota;

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

Route::get('/', "PrincipalController@index")->name('principal')->middleware('guest');
Route::get('/home', "HomeController@index")->name('home');
Route::get('/login', "UserController@loginForm")->name('login')->middleware('guest');
Route::post('/logar', "UserController@logar")->name('logar');
Route::get('/logout', "UserController@logout")->name('logout');
Route::get('/resetpassword', "UserController@resetpassword")->name('resetpassword');
Route::post('/resetpassword', "UserController@resetpassword_req");
Route::get('/verify_code/{id_reset}', "UserController@verifycode");
Route::put('/verifycode/{id_reset}', "UserController@verifycode_put");

/*rota para consultar nota*/
Route::group(['prefix' => "consultar",], function () {
    Route::get('/', "PrincipalController@consultar")->name('consultar');
    Route::get('/dados', "PrincipalController@dados");
});
/*fim */

Route::group(['prefix' => "user", 'middleware' => "auth"], function () {
    Route::get('/profile', "UserController@profile");
    Route::post('/updateprofile', "UserController@updateprofile");
});

Route::group(['prefix' => 'ajax', 'middleware' => "auth"], function () {
    Route::post('/getClasses', "AjaxController@getClasses")->name('getClasses');
    Route::post('/getClasses2', "AjaxController@getClasses2")->name('getClasses2');
    Route::post('/getClasses3', "AjaxController@getClasses3")->name('getClasses3');
    Route::post('/getClasses4', "AjaxController@getClasses4")->name('getClasses4');
    Route::post('/getMunicipios', "AjaxController@getMunicipios")->name('getMunicipios');
    Route::post('/getTurmas', "AjaxController@getTurmas")->name('getTurmas');
    Route::post('/getEncarregados', "AjaxController@getEncarregados")->name('getEncarregados');
    Route::post('/getDisciplinas', "AjaxController@getDisciplinas")->name('getDisciplinas');
    Route::get('/addDisciplinas', "AjaxController@addDisciplinas")->name('addDisciplinas');
    Route::get('/getDisciplinasSelecionadas', "AjaxController@getDisciplinasSelecionadas")->name('getDisciplinasSelecionadas');
    Route::get('/removeDisciplinas', "AjaxController@removeDisciplinas")->name('removeDisciplinas');

    Route::post('/searchEstudantes', "AjaxController@searchEstudantes")->name('searchEstudantes');
    Route::post('/searchFuncionarios', "AjaxController@searchFuncionarios")->name('searchFuncionarios');
    Route::post('/searchUsuarios', "AjaxController@searchUsuarios")->name('searchUsuarios');
    Route::post('/searchEncarregados', "AjaxController@searchEncarregados")->name('searchEncarregados');
    Route::post('/getDisciplinasCad', "AjaxController@getDisciplinasCad")->name('getDisciplinasCad');
    Route::post('/getDisciplinasCad2', "AjaxController@getDisciplinasCad2")->name('getDisciplinasCad2');
    Route::post('/getDisciplinasCad3', "AjaxController@getDisciplinasCad3")->name('getDisciplinasCad3');
    Route::post('/getHoras', "AjaxController@getHoras")->name('getHoras');
    Route::post('/getFuncionarios', "AjaxController@getFuncionarios")->name('getFuncionarios');

    Route::post('/updateAvaliacao', "AjaxController@updateAvaliacao")->name('updateAvaliacao');
    Route::post('/updateProva', "AjaxController@updateProva")->name('updateProva');
    Route::post('/updateGlobal', "AjaxController@updateGlobal")->name('updateGlobal');
    Route::post('/updateRecurso', "AjaxController@updateRecurso")->name('updateRecurso');
    Route::post('/updateNEENEO', "AjaxController@updateNEENEO")->name('updateNEENEO');

    Route::post('/updateAV_mensal', "AjaxController@updateAV_mensal")->name('updateAV_mensal');
    Route::post('/updateTP_mensal', "AjaxController@updateTP_mensal")->name('updateTP_mensal');

    Route::post('/updateProvaEJA', "AjaxController@updateProvaEJA")->name('updateProvaEJA');


    Route::post('/getCursoEnsino', "AjaxController@getCursoEnsino")->name('getCursoEnsino');
    Route::post('/getDisciplinasCurso', "AjaxController@getDisciplinasCurso")->name('getDisciplinasCurso');

    Route::post('/getBalancoDiario', "AjaxController@getBalancoDiario")->name('getBalancoDiario');

    Route::post('/getPagamentosEfectuados', "AjaxController@getPagamentosEfectuados")->name('getPagamentosEfectuados');

    Route::post('/encarregadoModal', "AjaxController@encarregadoModal")->name('encarregadoModal');
    Route::post('/updateObservacao', "AjaxController@updateObservacao")->name('updateObservacao');
});

Route::group(['prefix' => 'institucional', 'middleware' => "admin"], function () {
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
        Route::get('/import', "InstitucionalController@turma_import");
        Route::post('/import/store', "InstitucionalController@turma_importStore");
    });

    Route::group(['prefix' => 'disciplinas',], function () {
        Route::get('/', "InstitucionalController@disciplina_list");
        Route::get('/create', "InstitucionalController@disciplina_create");
        Route::post('/store', "InstitucionalController@disciplina_store");
        Route::get('/edit/{id}', "InstitucionalController@disciplina_edit");
        Route::put('/update/{id}', "InstitucionalController@disciplina_update");
        Route::get('/import', "InstitucionalController@diciplina_import");
        Route::post('/import/store', "InstitucionalController@disciplina_importStore");
    });

    Route::group(['prefix' => 'grades',], function () {
        Route::get('/', "InstitucionalController@grade_list");
        Route::get('/create', "InstitucionalController@grade_create");
        Route::post('/store', "InstitucionalController@grade_store");
        Route::get('/edit/{id}', "InstitucionalController@grade_edit");
        Route::put('/update/{id}', "InstitucionalController@grade_update");
        Route::get('/export', "InstitucionalController@grade_export");
        Route::get('/import', "InstitucionalController@grade_import");
        Route::post('/import/store', "InstitucionalController@grade_importStore");
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


    Route::group(['prefix' => "observacoes", 'middleware' => "admin"], function () {
        Route::get('/', "InstitucionalController@observacoes");

        Route::group(['prefix' => "geral"], function () {
            Route::get('/', "InstitucionalController@geral_list");
            Route::get('/create', "InstitucionalController@geral_create");
            Route::post('/store', "InstitucionalController@geral_store");
            Route::get('/edit/{id_observacao}', "InstitucionalController@geral_edit");
            Route::put('/update/{id_observacao}', "InstitucionalController@geral_update");
        });

        Route::group(['prefix' => "conjunta"], function () {
            Route::get('/', "InstitucionalController@conjunta_list");
            Route::get('/create', "InstitucionalController@conjunta_create");
            Route::post('/store', "InstitucionalController@conjunta_store");
            Route::get('/edit/{id_observacao}', "InstitucionalController@conjunta_edit");
            Route::get('/update/{id_observacao}', "InstitucionalController@conjunta_update");
        });
    });

    Route::group(['prefix' => "recursos"], function () {
        Route::get('/', "InstitucionalController@recursos_list");
        Route::get('/create', "InstitucionalController@recursos_create");
        Route::post('/store', "InstitucionalController@recursos_store");
        Route::get('/edit/{id}', "InstitucionalController@recursos_edit");
        Route::put('/update/{id}', "InstitucionalController@recursos_update");
    });

    Route::group(['prefix' => "exames"], function () {
        Route::get('/', "InstitucionalController@exames_list");
        Route::get('/create', "InstitucionalController@exames_create");
        Route::post('/store', "InstitucionalController@exames_store");
        Route::get('/edit/{id}', "InstitucionalController@exames_edit");
        Route::put('/update/{id}', "InstitucionalController@exames_update");
    });

    Route::group(['prefix' => "ordenar_disciplinas"], function () {
        Route::get('/', "InstitucionalController@ordenar_disciplinas_list");
        Route::get('/create', "InstitucionalController@ordenar_disciplinas_create");
        Route::post('/store', "InstitucionalController@ordenar_disciplinas_store");
        Route::get('/edit/{id}', "InstitucionalController@ordenar_disciplinas_edit");
        Route::put('/update/{id}', "InstitucionalController@ordenar_disciplinas_update");
    });
});

Route::group(['prefix' => 'bloqueios', 'middleware' => "AdminUser"], function () {
    Route::get('/', "BloqueioController@index");
    Route::get('/update/{id}', "BloqueioController@update");
    Route::get('/config/{id}', "BloqueioController@config");
    Route::get('/config/update/{id}', "BloqueioController@updateconfig");
});

Route::group(['prefix' => 'financas', 'middleware' => "AdminUser"], function () {
    Route::group(['prefix' => 'tabela_precos'], function () {
        Route::get('/', "FinancaController@tabela_preco_list");
        Route::get('/create', "FinancaController@tabela_preco_create");
        Route::post('/store', "FinancaController@tabela_preco_store");
        Route::get('/edit/{id}', "FinancaController@tabela_preco_edit");
        Route::put('/update/{id}', "FinancaController@tabela_preco_update");
    });

    Route::group(['prefix' => 'tipo_pagamentos'], function () {
        Route::get('/', "FinancaController@tipo_pagamento_list");
        Route::get('/create', "FinancaController@tipo_pagamento_create");
        Route::post('/store', "FinancaController@tipo_pagamento_store");
        Route::get('/edit/{id}', "FinancaController@tipo_pagamento_edit");
        Route::put('/update/{id}', "FinancaController@tipo_pagamento_update");
    });

    Route::group(['prefix' => "saidas"], function () {
        Route::get('/', "FinancaController@saidas_list");
        Route::get('/create', "FinancaController@saidas_create");
        Route::post('/store', "FinancaController@saidas_store");
        Route::get('/edit/{id}', "FinancaController@saidas_edit");
        Route::put('/update/{id}', "FinancaController@saidas_update");
    });
});

Route::group(['prefix' => 'encarregados', 'middleware' => "AdminSuperUser"], function () {
    Route::get('/', "EncarregadoController@index");
    Route::get('/create', "EncarregadoController@create");
    Route::post('/store', "EncarregadoController@store");
    Route::get('/edit/{id}', "EncarregadoController@edit");
    Route::put('/update/{id}', "EncarregadoController@update");
});

Route::group(['prefix' => 'estudantes', 'middleware' => "AdminSuperUser"], function () {
    Route::get('/', "EstudanteController@index");
    Route::get('/create', "EstudanteController@create");
    Route::post('/store', "EstudanteController@store");
    Route::get('/edit/{id}', "EstudanteController@edit");
    Route::put('/update/{id}', "EstudanteController@update");
    Route::post('/destroy', "EstudanteController@destroy");

    Route::get('/confirmar/{id_estudantes}', "EstudanteController@confirmar");
    Route::put('/store_confirmar/{id_estudante}', "EstudanteController@store_confirmar");
    Route::get('/ficha/{id_estudante}/{ano_lectivo}', "EstudanteController@ficha");
    Route::get('/declaracao/{id_estudante}/{ano_lectivo}', "EstudanteController@declaracao");
    Route::put('/store_declaracao/{id_estudante}', "EstudanteController@store_declaracao");
    Route::get('/guiatransferencia/{id_estudante}/{ano_lectivo}', "EstudanteController@guiatransferencia");
    Route::put('/store_guiatransferencia/{id_estudante}', "EstudanteController@store_guiatransferencia");
    Route::get('/desistencia/{id_estudante}/{ano_lectivo}', "EstudanteController@desistencia");
    Route::put('/store_desistencias/{id_estudante}', "EstudanteController@store_desistencias");
    Route::get('/declaracaocom/{id_declaracao}', "EstudanteController@choose_declaracao");

    Route::get('/extrato/{id_estudante}/{ano_lectivo}', "EstudanteController@extrato");

    Route::get('/restringir_notas', "EstudanteController@restringir_notas");
    Route::post('/restringir', "EstudanteController@restringir");
    Route::get('/restringir/destroy', "EstudanteController@restringir_destroy");

    Route::get('/termo/{id}/{ano_lectivo}', "EstudanteController@termo");

    Route::get('/search_advanced', "EstudanteController@search_advanced");
    Route::post('/search_advanced', "EstudanteController@search_advancedP");
});

Route::group(['prefix' => "turmas", 'middleware' => "AdminSuperUser"], function () {
    Route::get('/list/{ano}', "TurmasController@index");
    Route::get('/import/create/{id_turma}/{ano_lectivo}', "TurmasController@import_create");
    Route::post('/import/store', "TurmasController@import_store");
});

Route::group(['prefix' => "mapas", 'middleware' => "AdminUserSuperMaster"], function () {
    Route::get('/', "MapaController@index");
    Route::get('/aproveitamento/{ano_lectivo}', "MapaController@aproveitamento");
    Route::get('/coordenadores/{ano_lectivo}', "MapaController@coordenadores");
    Route::get('/estatistica/{ano_lectivo}', "MapaController@estatistica");
    Route::get('/saidas', "MapaController@saidas");

    Route::group(['prefix' => "balancos"], function () {
        Route::get('/', "MapaController@balancos");
        Route::get('/geral/{ano_lectivo}', "MapaController@balanco_geral");
        Route::get('/categoria/{ano_lectivo}', "MapaController@balanco_categoria");
        Route::get('/diario', "MapaController@balanco_diario");
    });
});

Route::group(['prefix' => 'pagamentos', 'middleware' => "user"], function () {
    Route::get('/listar/{id_estudante}/{ano_lectivo}', "PagamentoController@listar");
    Route::get('/create/{id_tipo_pagamento}', "PagamentoController@create");
    Route::post('/store', "PagamentoController@store");
    Route::post('/show', "PagamentoController@show")->name('show_pagamento');
    Route::post('/destroy', "PagamentoController@destroy")->name('delete_pagamento');
    Route::post('/update', "PagamentoController@update")->name('update_pagamento');
    Route::get('/mapas', "PagamentoController@mapas");
});

Route::group(['prefix' => 'funcionarios', 'middleware' => "AdminSuper"], function () {
    Route::get('/', "FuncionarioController@index");
    Route::get('/create', "FuncionarioController@create");
    Route::post('/store', "FuncionarioController@store");
    Route::get('/edit/{id}', "FuncionarioController@edit");
    Route::put('/update/{id}', "FuncionarioController@update");
    Route::post('/destroy', "FuncionarioController@destroy");

    Route::get('/export', "FuncionarioController@export");
    Route::get('/import', "FuncionarioController@import");
    Route::post('/import/store', "FuncionarioController@store_import");
});

Route::group(['prefix' => 'directores', 'middleware' => "AdminSuper"], function () {
    Route::get('/', "DirectorTurmaController@index");
    Route::get('/create', "DirectorTurmaController@create");
    Route::post('/store', "DirectorTurmaController@store");
    Route::get('/edit/{id}', "DirectorTurmaController@edit");
    Route::put('/update/{id}', "DirectorTurmaController@update");
    Route::get('/destroy/{id}', "DirectorTurmaController@destroy");

    Route::get('/export', "DirectorTurmaController@export");
    Route::get('/import', "DirectorTurmaController@import");
    Route::post('/import/store', "DirectorTurmaController@import_store");
});


Route::group(['prefix' => "horarios", 'middleware' => "AdminUser"], function () {
    Route::get('/create/{id_funcionario}', "HorarioController@create");
    Route::put('/store/{id_funcionario}', "HorarioController@store");
    Route::get('/destroy/{id_horario}', "HorarioController@destroy");

    Route::get('/export', "HorarioController@export");
    Route::get('/import', "HorarioController@import");
    Route::post('/import/store', "HorarioController@import_store");
});

Route::group(['prefix' => "offline_online", 'middleware' => "AdminUserSuperMaster"], function () {
    Route::get('/list', "OfflineOnlineController@list");
    Route::get('/estudantes', "OfflineOnlineController@estudantes");
});

Route::group(['prefix' => 'estatisticas', 'middleware' => "auth"], function () {

    Route::group(['prefix' => 'pagamentos', 'middleware' => "MasterAdminUser"], function () {
        Route::get('/', "EstatisticaController@lista_pagamento");
    });

    Route::group(['prefix' => 'balancos', 'middleware' => "MasterAdminUser"], function () {
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
    Route::get('/lista_nominal/{id_turma}/{ano_lectivo}', "RelatorioController@lista_nominal")->middleware('auth');
    Route::get('/declaracaosem/{id_declaracao}', "RelatorioController@declaracaosem");
    Route::get('/guiatransferencia/{id_transferencia}', "RelatorioController@guiatransferencia");
    Route::put('/boletins/{id_turma}/{ano_lectivo}', "RelatorioController@boletins");
    Route::put('/declaracao/{id_declaracao}', "RelatorioController@declaracaocom");

    Route::get('/mapas_coordenadores/{id_ensino}/{ano_lectivo}', "RelatorioController@mapas_coordenadores");
    Route::post('/mapas_aproveitamentos', "RelatorioController@mapas_aproveitamentos");
    Route::post('/mapas_estatistica', "RelatorioController@mapas_estatistica");

    Route::get('/extrato_pagamentos/{id_estudante}/{ano_lectivo}', "RelatorioController@extrato_pagamentos");
    Route::post('/estatistica_geral', "RelatorioController@estatistica_geral");

    Route::get('/balancoDiario/{data1}/{data2}', "RelatorioController@balancoDiario");
    Route::put('/pautatrimestral/{id_turma}/{ano_lectivo}', "RelatorioController@pautatrimestral");

    Route::post('/saidas', "RelatorioController@saidas");
});


Route::group(['prefix' => 'cadernetas', 'middleware' => "prof"], function () {
    Route::get('/list/{lastYear}', "CadernetaController_copy@list");
    Route::get('/create/{id_turma}/{id_disciplina}/{ano_lectivo}/{epoca}', "CadernetaController_copy@create");
    Route::get('/ejamensal/{id_turma}/{id_disciplina}/{ano_lectivo}/{epoca}/{mes}/{semana}', "CadernetaController_copy@ejamensal");
    Route::get('/ejatrimestral/{id_turma}/{id_disciplina}/{ano_lectivo}/{epoca}', "CadernetaController_copy@ejatrimestral");

    Route::get('/store/{id_turma}/{id_disciplina}/{ano_lectivo}', "CadernetaController_copy@store");
    Route::get('/store_copy/{id_turma}/{id_disciplina}/{epoca}/{ano_lectivo}', "CadernetaController_copy@store_copy");
    Route::get('/store_copy_ejamensal/{id_turma}/{id_disciplina}/{epoca}/{mes}/{ano_lectivo}', "CadernetaController_copy@store_copy_ejamensal");
    Route::get('/store_copy_ejatrimestral/{id_turma}/{id_disciplina}/{epoca}/{ano_lectivo}', "CadernetaController_copy@store_copy_ejatrimestral");

    Route::get('/printer/{id_turma}/{id_disciplina}/{ano_lectivo}', "RelatorioController@minipauta");
});

Route::group(['prefix' => 'minipautas', 'middleware' => "auth"], function () {
    Route::get('/show/{id_turma}/{id_disciplina}/{ano_lectivo}', "MiniPautaController_copy@show");
});


Route::group(['prefix' => 'minha_turma', 'middleware' => "AdminProfSuper"], function () {
    Route::get('/list/{lastYear}', "MinhaTurmaController@list");
    Route::get('/horario/{id_turma}/{ano_lectivo}', "MinhaTurmaController@horario");
    Route::get('/boletins_notas/{id_turma}/{ano_lectivo}', "MinhaTurmaController@boletins_notas");
    Route::get('/fotografias/{id_turma}/{ano_lectivo}', "MinhaTurmaController@fotografias");
    Route::put('/updateFoto/{id_pessoa}/{ano_lectivo}/{id_turma}', "MinhaTurmaController@updateFoto");
    Route::get('/pautatrimestre/{id_turma}/{ano_lectivo}', "MinhaTurmaController@pautatrimestre");
});

Route::group(['prefix' => 'pautas', 'middleware' => "AdminProfSuper"], function () {
    Route::get('/create/{id_turma}/{ano_lectivo}', "PautaController_copy@create");
    Route::put('/show/{id_turma}/{ano_lectivo}', "PautaController_copy@show");

    Route::get('/pdf/{id_turma}/{ano_lectivo}', "RelatorioController@pauta");
});

Route::group(['prefix' => 'usuarios', 'middleware' => "admin"], function () {
    Route::get('/', "UserController@index");
    Route::get('/create', "UserController@create");
    Route::post('/store', "UserController@store");
    Route::get('/edit/{id}', "UserController@edit");
    Route::put('/update/{id}', "UserController@update");
    Route::get('/print', "RelatorioController@printusers");
});

Route::group(['prefix' => "about"], function () {
    Route::get('/sistema', "AboutController@sistema");
    Route::get('/instituicao', "AboutController@instituicao");
});

Route::group(['prefix' => "word", 'middleware' => "AdminSuperUser"], function () {
    Route::get('declaracaosem/{id_declaracao}', "PhpWordController@declaracaosemnota");
    Route::get('declaracaocom/{id_declaracao}', "PhpWordController@declaracaocomnota");
    Route::put('termo/{id_estudante}/{ano_lectivo}', "PhpWordController@termo");
});


Route::group(['prefix' => "excel"], function () {
    Route::get('lista_nominal/{id_turma}/{ano_lectivo}', "ExcelController@lista_nominal");
    Route::get('minipautas/{id_turma}/{id_disciplina}/{ano_lectivo}', "ExcelController@minipautas");
    Route::get('pauta/{id_turma}/{ano_lectivo}', "ExcelController@pauta");
});

/*rota de test*/
Route::get('/test', function () {
    $restricao = RestricaoNota::all();

    return $restricao;
});



/*fim*/


/**eliminar estudantes */

Route::get('/elminar_estudantes/{id_estudante}', function ($id_estudante) {
    /*$estudante = Estudante::find($id_estudante);
    if (!$estudante) {
        return "Estudante nao encontrado";
    }
    $historico = HistoricEstudante::where(['id_estudante' => $id_estudante])->first();
    $id_pessoa = $estudante->id_pessoa;
    $nome = $estudante->pessoa->nome;


    Avaliacao::where(['id_estudante' => $estudante->id])->delete();
    Prova::where(['id_estudante' => $estudante->id])->delete();
    Declaracao::where(['id_estudante' => $estudante->id])->delete();
    Transferencia::where(['id_estudante' => $estudante->id])->delete();
    Desistencia::where(['id_estudante' => $estudante->id])->delete();
    Pagamento::where(['id_estudante' => $estudante->id])->delete();
    Finals::where(['id_estudante' => $estudante->id])->delete();
    Trimestral::where(['id_estudante' => $estudante->id])->delete();
    RestricaoNota::where(['id_estudante' => $estudante->id])->delete();
    Multado::where(['id_estudante' => $estudante->id])->delete();
    DocumentoEntregue::where(['id_historico' => $historico->id])->delete();
    HistoricEstudante::where(['id_estudante' => $estudante->id])->delete();
    Estudante::find($estudante->id)->delete();
    Pessoa::find($id_pessoa)->delete();

    echo "eliminado com sucesso    => " . $nome;*/
});

Route::get('/text1', function () {

    /* $numero = 6.37;
    $numero_round = round($numero,1);
    echo number_format($numero_round,1,',','.');*/


    /*$phpword = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpword->createSection();
    $section->addText('Hello world');
    $file = "hello.docx";

    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    header("Content-Transfer-Encoding: binary");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Expires: 0");
    $xmlwriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpword, "Word2007");

    return view('welcome');*/
    //$xmlwriter->save("php://output");
});
