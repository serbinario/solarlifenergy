<?php

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


Auth::routes();

Route::get('/', 'ClienteController@index')
    ->name('cliente.cliente.index');
/*
Route::get('/error', 'ClienteController@index')
    ->name('cliente.cliente.index');
*/



Route::post('/consultaCpfCnpf', 'UtilController@consultaCpfCnpf')
    ->name('cliente.consultaCpfCnpf');

Route::get('criarProjeto/{id}', 'UtilController@criarProjeto')
    ->name('criarProjeto.criarProjeto');

Route::post('criarContrato/', 'UtilController@criarContrato')
    ->name('criarContrato.criarContrato');

Route::post('deletaContratoConcercionaria/', 'UtilController@deletaContratoConcercionaria')
    ->name('deletaContratoConcercionaria');

Route::post('arquivarProposta/', 'UtilController@arquivarProposta')
    ->name('arquivarProposta.arquivarProposta');

Route::post('simular/', 'UtilController@simular')
    ->name('simular.simular');

Route::post('arquivarProjeto/', 'UtilController@arquivarProjeto')
    ->name('arquivarProjeto.arquivarProjeto');

Route::get('/consultaCidades/{id}', 'UtilController@getCidades')
    ->name('getEstado');

Route::post('/getclientes/', 'UtilController@getClientes')
    ->name('getclientes');

//Route::any('/simulador', ['middleware' => 'cors' , 'simulador'=> 'UtilController@simulador']);
Route::any('/simulador', 'UtilController@simulador')->name('simulador')->middleware('cors');
//Route::get('myRoute', ['middleware' => 'cors' , 'uses'=> 'MyController@Action']

//Route::get('/home', 'HomeController@index')->name('home');

//Url para receber reuqest do boletofacil
Route::any('/notificationUrl', 'NotificationUrl@notificationUrl')->name('notificationUrl');

Route::any('/report/{id}/FichaElaboracaoProjeto', 'ReportController@reportPdfFichaElaboracaoProjeto')->name('reportIndex');
Route::any('/report/{id}/Procuracao', 'ReportController@reportPdfProcuracao')->name('reportIndexProcuracao');
Route::any('/report/{id}/Contrato', 'ReportController@reportPdfContrato')->name('reportIndexContrato');
Route::any('/report/{id}/Declaracao', 'ReportController@reportPdfDeclaracao')->name('reportIndexDeclaracao');
Route::any('/report/{id}/proposta', 'ReportController@reportPdfProposta')->name('reportIndexProposta');
Route::get('/report/reportPdf', 'ReportController@reportPdf')->name('reportPdf');
Route::any('/report/ProjetosParecerAcesso', 'ReportController@reportPdfParecerAcesso')->name('reportPdfParecerAcesso');

Route::any('/report/reportProjetos', 'ReportController@reportProjeto')->name('reportProjeto');

Route::any('/report/lerArquivo', 'ReportController@lerArquivo')->name('lerArquivo');


//Route::any('/enableDisableSecret', 'NotificationUrl@notificationUrl')->name('notificationUrl');



Route::group(
    [
        'prefix' => 'report',
    ], function () {

    Route::get('/financeiro', 'ReportController@reportPdfFinanceiro')
        ->name('report.financeiro');

    Route::get('/financeiroCliente', 'ReportController@reportPdfFinanceiroCliente')
        ->name('report.financeiroCliente');
});

Route::group(
    [
        'prefix' => 'documento',
    ], function () {

    Route::get('/index', 'DocumentoController@index')
        ->name('documento.index');

    Route::get('/grid', 'DocumentoController@grid')
        ->name('documento.grid');

});

Route::group(
    [
        'prefix' => 'inversorModulo',
    ], function () {

    Route::get('/index', 'InversorModulosController@index')
        ->name('inversor_modulo.index');

    Route::get('/grid', 'InversorModulosController@grid')
        ->name('inversor_modulo.grid');

    Route::get('/{id}/edit','InversorModulosController@edit')
        ->name('inversor_modulo.edit')
        ->where('id', '[0-9]+');

    Route::put('/{id}', 'InversorModulosController@update')
        ->name('inversor_modulo.update')
        ->where('id', '[0-9]+');

});


Route::group(
    [
        'prefix' => 'documentoUpload',
    ], function () {

    Route::post('/upload', 'DocumentoUploadController@upload')
        ->name('documentoUpload.upload');

    Route::post('/update', 'DocumentoController@updateUpload')
        ->name('documento.update');

    Route::get('/grid', 'DocumentoController@grid')
        ->name('documento.grid');

});


Route::group(
    [
        'prefix' => 'modulo',
    ], function () {

    Route::get('/edit','ModuloController@edit')
        ->name('modulo.edit')
        ->where('id', '[0-9]+');

    Route::get('/', 'ModuloController@index')
        ->name('modulo.index');

    Route::get('/grid', 'ModuloController@grid')
        ->name('modulo.grid');

    Route::get('/create', 'ModuloController@create')
        ->name('modulo.create');

    Route::get('/{id}/edit','ModuloController@edit')
        ->name('modulo.edit');

    Route::put('/update/{id}', 'ModuloController@update')
        ->name('modulo.update');

    Route::post('/', 'ModuloController@store')
        ->name('modulo.store');

});

Route::group(
    [
        'prefix' => 'category',
    ], function () {

    Route::get('/edit','CategoryController@edit')
        ->name('category.edit')
        ->where('id', '[0-9]+');

    Route::get('/', 'CategoryController@index')
        ->name('category.index');

    Route::get('/grid', 'CategoryController@grid')
        ->name('category.grid');

    Route::get('/create', 'CategoryController@create')
        ->name('category.create');

    Route::get('/{id}/edit','CategoryController@edit')
        ->name('category.edit');

    Route::put('/update', 'CategoryController@update')
        ->name('category.update');

    Route::post('/', 'CategoryController@store')
        ->name('category.store');

});

Route::group(
    [
        'prefix' => 'geral',
    ], function () {

    Route::get('/edit','GeralController@edit')
        ->name('geral.edit')
        ->where('id', '[0-9]+');

    Route::get('/', 'GeralController@indexPedido')
        ->name('geral.index');

    Route::get('/grid', 'GeralController@grid')
        ->name('geral.grid');

    Route::post('/saveproducts', 'GeralController@store')
        ->name('geral.create');

    Route::post('/getPedido', 'GeralController@getPedido')
        ->name('geral.getpedido');

    Route::put('/update', 'GeralController@update')
        ->name('geral.update');

    Route::get('/financeiroCliente', 'GeralController@reportPdfFinanceiroCliente')
        ->name('geral.financeiroCliente');

    Route::get('/getallproducts', 'GeralController@getAllProducts')
        ->name('geral.financeiroCliente');
});

Route::group(
    [
        'prefix' => 'orcamento',
    ], function () {

    Route::get('/novo', 'PedidoController@index')
        ->name('orcamento.index');

    Route::get('/', 'PedidoController@indexPedido')
        ->name('pedido.index');

    Route::get('/grid', 'PedidoController@grid')
        ->name('pedido.grid');

    Route::post('/saveproducts', 'PedidoController@store')
        ->name('pedido.create');

    Route::post('/getPedido', 'PedidoController@getPedido')
        ->name('pedido.getpedido');

    Route::post('/updatePedido', 'PedidoController@updatePedido')
        ->name('pedido.updatePedido');

    Route::get('/financeiroCliente', 'ReportController@reportPdfFinanceiroCliente')
        ->name('report.financeiroCliente');

    Route::get('/getallproducts', 'PedidoController@getAllProducts')
        ->name('report.financeiroCliente');
});

Route::group(
    [
        'prefix' => 'maoObra',
    ], function () {

    Route::get('/', 'MaoObraModulosController@index')
        ->name('mao_obra.index');

    Route::get('/grid', 'MaoObraModulosController@grid')
        ->name('mao_obra.index.grid');

    Route::get('/{mao_obra}/edit','MaoObraModulosController@edit')
        ->name('mao_obra.edit')
        ->where('id', '[0-9]+');
    Route::put('/{cliente}', 'MaoObraModulosController@update')
        ->name('mao_obra.update')
        ->where('id', '[0-9]+');
    Route::get('/create','ClienteController@create')
        ->name('mao_obra.create');
});




Route::group(
    [
        'prefix' => 'dashboard',
    ], function () {

    Route::get('/', 'Dashboard@index')
        ->name('dashboard.index');

    Route::get('/clientesPorMes','Dashboard@clientesPorMes')
        ->name('dashboard.clientesPorMes');

    Route::get('/grid', 'RouterController@grid')
        ->name('dashboard.router.grid');

    Route::get('/getProjetos', 'Dashboard@getProjetos')
        ->name('dashboard.getProjetos');
});

Route::group(
[
    'prefix' => 'cliente',
], function () {

    Route::get('/', 'ClienteController@index')
         ->name('cliente.cliente.index');

    Route::get('/inativos', 'ClienteController@inativos')
        ->name('cliente.inativos');

    Route::get('/inativos/grid', 'ClienteController@inativosGrid')
        ->name('cliente.inativos.grid');

    Route::get('/create','ClienteController@create')
         ->name('cliente.cliente.create');

    Route::get('/grid', 'ClienteController@grid')
         ->name('cliente.cliente.grid');

    Route::get('/grid', 'ClienteController@grid')
        ->name('cliente.cliente.grid');

    Route::get('/coordenadas','ClienteController@coordenadas')
         ->name('cliente.coordenadas')
         ->where('id', '[0-9]+');

    Route::get('/{cliente}/edit','ClienteController@edit')
         ->name('cliente.cliente.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ClienteController@store')
         ->name('cliente.cliente.store');
               
    Route::put('cliente/{cliente}', 'ClienteController@update')
         ->name('cliente.cliente.update')
         ->where('id', '[0-9]+');

    Route::post('getCliente/{cliente}', 'ClienteController@getCliente')
        ->name('cliente.getCliente.update')
        ->where('id', '[0-9]+');

    Route::delete('/{cliente}/destroy','ClienteController@destroy')
         ->name('cliente.cliente.destroy')
         ->where('id', '[0-9]+');

});







Route::group(
[
    'prefix' => 'contrato_celpe',
], function () {

    Route::get('/', 'ContratoCelpeController@index')
         ->name('contrato_celpe.contrato_celpe.index');

    Route::get('/create','ContratoCelpeController@create')
         ->name('contrato_celpe.contrato_celpe.create');

    Route::get('/grid', 'ContratoCelpeController@grid')
         ->name('[% grid_route_name %]');

    Route::get('/show/{contratoCelpe}','ContratoCelpeController@show')
         ->name('contrato_celpe.contrato_celpe.show')
         ->where('id', '[0-9]+');

    Route::get('/{contratoCelpe}/edit','ContratoCelpeController@edit')
         ->name('contrato_celpe.contrato_celpe.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ContratoCelpeController@store')
         ->name('contrato_celpe.contrato_celpe.store');
               
    Route::put('contrato_celpe/{contratoCelpe}', 'ContratoCelpeController@update')
         ->name('contrato_celpe.contrato_celpe.update')
         ->where('id', '[0-9]+');

    Route::delete('/{contratoCelpe}/destroy','ContratoCelpeController@destroy')
         ->name('contrato_celpe.contrato_celpe.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'users',
], function () {

    Route::get('/', 'UsersController@index')
         ->name('users.user.index');

    Route::get('/create','UsersController@create')
         ->name('users.user.create');

    Route::get('/show/{user}','UsersController@show')
         ->name('users.user.show')
         ->where('id', '[0-9]+');

    Route::get('/grid', 'UsersController@grid')
        ->name('users.user.grid');


    Route::get('/{user}/edit','UsersController@edit')
         ->name('users.user.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'UsersController@store')
         ->name('users.user.store');
               
    Route::put('user/{user}', 'UsersController@update')
         ->name('users.user.update')
         ->where('id', '[0-9]+');

    Route::delete('/{user}/destroy','UsersController@destroy')
         ->name('users.user.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'clienteweb',
], function () {

    Route::get('/', 'ClienteWebController@create')
         ->name('clienteweb');

    Route::post('/cliente_web.store', 'ClienteWebController@store')
        ->name('cliente_web.store');

});

Route::group(
[
    'prefix' => 'preProposta',
], function () {

    Route::get('/', 'PrePropostaController@index')
         ->name('pre_proposta.pre_proposta.index');

    Route::get('/create','PrePropostaController@create')
         ->name('pre_proposta.pre_proposta.create');

    Route::get('/grid', 'PrePropostaController@grid')
         ->name('grid');

    Route::get('/show/{preProposta}','PrePropostaController@show')
         ->name('pre_proposta.pre_proposta.show')
         ->where('id', '[0-9]+');

    Route::get('/{preProposta}/edit','PrePropostaController@edit')
         ->name('pre_proposta.pre_proposta.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'PrePropostaController@store')
         ->name('pre_proposta.pre_proposta.store');
               
    Route::put('pre_proposta/{preProposta}', 'PrePropostaController@update')
         ->name('pre_proposta.pre_proposta.update')
         ->where('id', '[0-9]+');

    Route::delete('/{preProposta}/destroy','PrePropostaController@destroy')
         ->name('pre_proposta.pre_proposta.destroy')
         ->where('id', '[0-9]+');

    Route::get('/arquivadas/index', 'PrePropostaArquivaController@index')
        ->name('pre_proposta.arquivadas.index');

    Route::get('/arquivadas/grid', 'PrePropostaArquivaController@grid')
        ->name('pre_proposta.arquivadas.grid');

});

Route::group(
    [
        'prefix' => 'proposta',
    ], function () {

    Route::get('/', 'PropostaController@index')
        ->name('proposta.index');

    Route::get('/create','PropostaController@create')
        ->name('proposta.create');

    Route::get('/grid', 'PropostaController@grid')
        ->name('grid');


    Route::get('/{proposta}/edit','PropostaController@edit')
        ->name('proposta.edit')
        ->where('id', '[0-9]+');

    Route::post('/', 'PropostaController@store')
        ->name('proposta.store');

    Route::put('pre_proposta/{preProposta}', 'PrePropostaController@update')
        ->name('pre_proposta.pre_proposta.update')
        ->where('id', '[0-9]+');

    Route::delete('/{preProposta}/destroy','PrePropostaController@destroy')
        ->name('pre_proposta.pre_proposta.destroy')
        ->where('id', '[0-9]+');

    Route::get('/arquivadas/index', 'PrePropostaArquivaController@index')
        ->name('pre_proposta.arquivadas.index');

    Route::get('/arquivadas/grid', 'PrePropostaArquivaController@grid')
        ->name('pre_proposta.arquivadas.grid');

});

Route::group(
[
    'prefix' => 'procuracao',
], function () {

    Route::get('/', 'ProcuracaoController@index')
         ->name('procuracao.procuracao.index');

    Route::get('/create','ProcuracaoController@create')
         ->name('procuracao.procuracao.create');

    Route::get('/grid', 'ProcuracaoController@grid')
         ->name('[% grid_route_name %]');

    Route::get('/show/{procuracao}','ProcuracaoController@show')
         ->name('procuracao.procuracao.show')
         ->where('id', '[0-9]+');

    Route::get('/{procuracao}/edit','ProcuracaoController@edit')
         ->name('procuracao.procuracao.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ProcuracaoController@store')
         ->name('procuracao.procuracao.store');
               
    Route::put('procuracao/{procuracao}', 'ProcuracaoController@update')
         ->name('procuracao.procuracao.update')
         ->where('id', '[0-9]+');

    Route::delete('/{procuracao}/destroy','ProcuracaoController@destroy')
         ->name('procuracao.procuracao.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'franquia',
], function () {

    Route::get('/', 'FranquiaController@index')
         ->name('franquia.franquia.index');

    Route::get('/create','FranquiaController@create')
         ->name('franquia.franquia.create');

    Route::get('/grid', 'FranquiaController@grid')
         ->name('franquia');

    Route::get('/show/{franquia}','FranquiaController@show')
         ->name('franquia.franquia.show')
         ->where('id', '[0-9]+');

    Route::get('/{franquia}/edit','FranquiaController@edit')
         ->name('franquia.franquia.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'FranquiaController@store')
         ->name('franquia.franquia.store');
               
    Route::put('franquia/{franquia}', 'FranquiaController@update')
         ->name('franquia.franquia.update')
         ->where('id', '[0-9]+');

    Route::delete('/{franquia}/destroy','FranquiaController@destroy')
         ->name('franquia.franquia.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'parametro',
], function () {

    Route::get('/', 'ParametroController@index')
         ->name('parametro.parametro.index');

    Route::get('/create','ParametroController@create')
         ->name('parametro.parametro.create');

    Route::get('/grid', 'ParametroController@grid')
         ->name('[% grid_route_name %]');

    Route::get('/show/{parametro}','ParametroController@show')
         ->name('parametro.parametro.show')
         ->where('id', '[0-9]+');

    Route::get('/{parametro}/edit','ParametroController@edit')
         ->name('parametro.parametro.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ParametroController@store')
         ->name('parametro.parametro.store');
               
    Route::put('parametro/{parametro}', 'ParametroController@update')
         ->name('parametro.parametro.update')
         ->where('id', '[0-9]+');

    Route::delete('/{parametro}/destroy','ParametroController@destroy')
         ->name('parametro.parametro.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'contrato',
], function () {

    Route::get('/', 'ContratoController@index')
         ->name('contrato.contrato.index');

    Route::get('/create','ContratoController@create')
         ->name('contrato.contrato.create');

    Route::get('/grid', 'ContratoController@grid')
         ->name('[% grid_route_name %]');

    Route::get('/show/{contrato}','ContratoController@show')
         ->name('contrato.contrato.show')
         ->where('id', '[0-9]+');

    Route::get('/{contrato}/edit','ContratoController@edit')
         ->name('contrato.contrato.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ContratoController@store')
         ->name('contrato.contrato.store');
               
    Route::put('contrato/{contrato}', 'ContratoController@update')
         ->name('contrato.contrato.update')
         ->where('id', '[0-9]+');

    Route::delete('/{contrato}/destroy','ContratoController@destroy')
         ->name('contrato.contrato.destroy')
         ->where('id', '[0-9]+');

});


Route::group(
[
    'prefix' => 'projetov2',
], function () {

    Route::get('/', 'Projetov2Controller@index')
         ->name('projetov2.projetov2.index');

    Route::get('/create','Projetov2Controller@create')
         ->name('projetov2.projetov2.create');

    Route::get('/grid', 'Projetov2Controller@grid')
         ->name('projetov2.index');

    Route::get('/show/{projetov2}','Projetov2Controller@show')
         ->name('projetov2.projetov2.show')
         ->where('id', '[0-9]+');

    Route::get('/{projetov2}/edit','Projetov2Controller@edit')
         ->name('projetov2.projetov2.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'Projetov2Controller@store')
         ->name('projetov2.projetov2.store');
               
    Route::put('projetov2/{projetov2}', 'Projetov2Controller@update')
         ->name('projetov2.projetov2.update')
         ->where('id', '[0-9]+');

    Route::delete('/{projetov2}/destroy','Projetov2Controller@destroy')
         ->name('projetov2.projetov2.destroy')
         ->where('id', '[0-9]+');

    Route::get('/arquivadas/index', 'ProjetoArquivadoController@index')
        ->name('projetov2.arquivados.index');

    Route::get('/arquivadas/grid', 'ProjetoArquivadoController@grid')
        ->name('projetov2.arquivados.grid');

});

Route::group(
    [
        'prefix' => 'produto',
    ], function () {

    Route::get('/', 'ProdutoController@index')
        ->name('produto.index');

    Route::get('/create','ProdutoController@create')
        ->name('produto.create');

    Route::get('/grid', 'ProdutoController@grid')
        ->name('produto.grid');

    Route::get('/{produto}/edit','ProdutoController@edit')
        ->name('produto.edit')
        ->where('id', '[0-9]+');

    Route::post('/', 'ProdutoController@store')
        ->name('produto.store');

    Route::put('produto/{id}', 'ProdutoController@update')
        ->name('produto.update')
        ->where('id', '[0-9]+');

    Route::delete('/{produto}/destroy','ProdutoController@destroy')
        ->name('produto.destroy')
        ->where('id', '[0-9]+');

    Route::get('/arquivadas/index', 'ProjetoArquivadoController@index')
        ->name('projetov2.arquivados.index');

    Route::get('/arquivadas/grid', 'ProjetoArquivadoController@grid')
        ->name('projetov2.arquivados.grid');

});
