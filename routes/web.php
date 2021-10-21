<?php

use App\AnoLectivo;
use App\EpocaPagamento;
use App\Estudante;
use App\Finals;
use App\FormaPagamento;
use App\Grade;
use App\HistoricEstudante;
use App\Horario;
use App\ObservacaoGeral;
use App\Pagamento;
use App\TabelaPreco;
use App\TipoPagamento;
use App\Trimestral;
use App\Turma;
use App\User;
use Illuminate\Support\Facades\Route;
use PhpOffice\PhpWord\TemplateProcessor;

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

    Route::post('/updateAV_mensal', "AjaxController@updateAV_mensal")->name('updateAV_mensal');
    Route::post('/updateTP_mensal', "AjaxController@updateTP_mensal")->name('updateTP_mensal');

    Route::post('/updateProvaEJA', "AjaxController@updateProvaEJA")->name('updateProvaEJA');


    Route::post('/getCursoEnsino', "AjaxController@getCursoEnsino")->name('getCursoEnsino');
    Route::post('/getDisciplinasCurso', "AjaxController@getDisciplinasCurso")->name('getDisciplinasCurso');
});

Route::group(['prefix' => 'institucional', 'middleware' => "AdminUser"], function () {
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
});

Route::group(['prefix' => 'bloqueios', 'middleware' => "AdminUser"], function () {
    Route::get('/', "BloqueioController@index");
    Route::get('/update/{id}', "BloqueioController@update");
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
});

Route::group(['prefix' => 'encarregados', 'middleware' => "AdminUser"], function () {
    Route::get('/', "EncarregadoController@index");
    Route::get('/create', "EncarregadoController@create");
    Route::post('/store', "EncarregadoController@store");
    Route::get('/edit/{id}', "EncarregadoController@edit");
    Route::put('/update/{id}', "EncarregadoController@update");
});

Route::group(['prefix' => 'estudantes', 'middleware' => "AdminUser"], function () {
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
    Route::get('/restringir_notas/{id_estudante}/{ano_lectivo}', "EstudanteController@restringir_notas");
});

Route::group(['prefix' => "turmas", 'middleware' => "AdminUser"], function () {
    Route::get('/list/{ano}', "TurmasController@index");
    Route::get('/import/create/{id_turma}/{ano_lectivo}', "TurmasController@import_create");
    Route::post('/import/store', "TurmasController@import_store");
});

Route::group(['prefix' => "mapas", 'middleware' => "AdminUser"], function () {
    Route::get('/', "MapaController@index");
    Route::get('/aproveitamento/{ano_lectivo}', "MapaController@aproveitamento");
    Route::get('/coordenadores/{ano_lectivo}', "MapaController@coordenadores");
    Route::get('/estatistica/{ano_lectivo}', "MapaController@estatistica");
});

Route::group(['prefix' => 'pagamentos', 'middleware' => "AdminUser"], function () {
    Route::get('/listar/{id_estudante}/{ano_lectivo}', "PagamentoController@listar");
    Route::get('/create/{id_tipo_pagamento}', "PagamentoController@create");
    Route::post('/store', "PagamentoController@store");
    Route::post('/show', "PagamentoController@show")->name('show_pagamento');
});

Route::group(['prefix' => 'funcionarios', 'middleware' => "AdminUser"], function () {
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

Route::group(['prefix' => 'directores', 'middleware' => "AdminUser"], function () {
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
    Route::get('/lista_nominal/{id_turma}/{ano_lectivo}', "RelatorioController@lista_nominal")->middleware('AdminProfUser');
    Route::get('/declaracaosem/{id_declaracao}', "RelatorioController@declaracaosem");
    Route::get('/guiatransferencia/{id_transferencia}', "RelatorioController@guiatransferencia");
    Route::put('/boletins/{id_turma}/{ano_lectivo}', "RelatorioController@boletins");
    Route::put('/declaracao/{id_declaracao}', "RelatorioController@declaracaocom");

    Route::get('/mapas_coordenadores/{id_ensino}/{ano_lectivo}', "RelatorioController@mapas_coordenadores");
    Route::post('/mapas_aproveitamentos', "RelatorioController@mapas_aproveitamentos");
    Route::post('/mapas_estatistica', "RelatorioController@mapas_estatistica");
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


Route::group(['prefix' => 'minha_turma', 'middleware' => "AdminProfUser"], function () {
    Route::get('/list/{lastYear}', "MinhaTurmaController@list");
    Route::get('/horario/{id_turma}/{ano_lectivo}', "MinhaTurmaController@horario");
    Route::get('/boletins_notas/{id_turma}/{ano_lectivo}', "MinhaTurmaController@boletins_notas");
    Route::get('/fotografias/{id_turma}/{ano_lectivo}', "MinhaTurmaController@fotografias");
    Route::put('/updateFoto/{id_pessoa}/{ano_lectivo}/{id_turma}', "MinhaTurmaController@updateFoto");
});

Route::group(['prefix' => 'pautas', 'middleware' => "AdminProfUser"], function () {
    Route::get('/create/{id_turma}/{ano_lectivo}', "PautaController_copy@create");
    Route::put('/show/{id_turma}/{ano_lectivo}', "PautaController_copy@show");

    Route::get('/pdf/{id_turma}/{ano_lectivo}', "RelatorioController@pauta");
});

Route::group(['prefix' => 'usuarios', 'middleware' => "AdminUser"], function () {
    Route::get('/', "UserController@index");
});

Route::group(['prefix' => "about"], function () {
    Route::get('/sistema', "AboutController@sistema");
    Route::get('/instituicao', "AboutController@instituicao");
});

Route::group(['prefix' => "word", 'middleware' => "AdminUser"], function () {
    Route::get('declaracaosem/{id_declaracao}', "PhpWordController@declaracaosemnota");
    Route::get('declaracaocom/{id_declaracao}', "PhpWordController@declaracaocomnota");
});

/*rota de test*/
Route::get('test', function () {
    $dia = date('d');
    $mes = date('m');
    $ano_lectivo = "2021-2022";
    $epoca = null;
    /**primeiro deve pegar os tipos de pagamentos que tem multa com os seus respentivos dias */
    $tipo_pagamentos = TipoPagamento::where(['multa' => "sim"])->where('dia_cobranca_multa', '<=', $dia)->get();
    foreach ($tipo_pagamentos as $tipo_pagamento) {
        echo "<b>" . $tipo_pagamento->tipo . "</b><br/>";
        /**pegar todas tabelas de precos dos pagamentos com multas */
        $tabela_precos = TabelaPreco::where(['id_tipo_pagamento' => $tipo_pagamento->id])->get();
        foreach ($tabela_precos as $tabela_preco) {
            echo "<b style='color:green;'>" . $tabela_preco->curso->curso . " == " . $tabela_preco->classe->classe . " == " . $tabela_preco->turno->turno . " == " . $tabela_preco->preco . "kz == " . $tabela_preco->percentagem_multa . "% </b> <br/>";
            /**pegar id de forma de pagamento */
            $forma_pagamento = FormaPagamento::where(['forma_pagamento' => $tabela_preco->forma_pagamento])->first();

            /*se a forma de pagamento for mensal*/
            if ($forma_pagamento->forma_pagamento == "Mensal") {
                /**pegar epocas de pagamentos */
                $epoca_pagamentos = EpocaPagamento::where(['id_forma_pagamento' => $forma_pagamento->id])
                    ->where('numero', '<', $mes)->get();


                foreach ($epoca_pagamentos as $epocas) {
                    echo "<b style='color:blue;'>" . $epocas->numero . " == " . $epocas->epoca . "</b><br/>";
                    /**pesquisar estudantes deste ano com multas */
                    $data = [
                        'epoca' => $epocas->epoca,
                        'id_classe' => $tabela_preco->id_classe,
                        'id_curso' => $tabela_preco->id_curso,
                    ];
                    $estudantes = Estudante::whereHas('turma', function ($query) use ($data) {
                        $query->where(['id_curso' => $data['id_curso'], 'id_classe' => $data['id_classe']]);
                    })->whereDoesntHave('pagamento', function ($query) use ($data) {
                        $query->where(['epoca' => $data['epoca']]);
                    })->where(['ano_lectivo' => $ano_lectivo])->get();
                    foreach ($estudantes as $estudante) {
                        //buscar estudantes que nao pagaram para aplicar multas
                        echo $estudante->pessoa->nome . "<br/>";
                        if(){

                        }
                    }
                }
            }
        }
        echo "<hr/>";
    }
});

/*fim*/