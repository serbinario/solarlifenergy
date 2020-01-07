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

Route::get('/error', 'ClienteController@index')
    ->name('cliente.cliente.index');

Route::post('/consultaCpfCnpf', 'UtilController@consultaCpfCnpf')
    ->name('cliente.consultaCpfCnpf');

Route::post('/simulaGeracao', 'UtilController@simulaGeracao')
    ->name('simulaGeracao');

//Route::get('/home', 'HomeController@index')->name('home');

//Url para receber reuqest do boletofacil
Route::any('/notificationUrl', 'NotificationUrl@notificationUrl')->name('notificationUrl');

Route::any('/report/{id}/FichaElaboracaoProjeto', 'ReportController@reportPdfFichaElaboracaoProjeto')->name('reportIndex');
Route::any('/report/{id}/Procuracao', 'ReportController@reportPdfProcuracao')->name('reportIndexProcuracao');

//RN-0001
Route::get('/cobrancasAPI', 'CobrancasAPIController@gerenciant')->name('cobrancasAPI.gerencianet');

Route::any('/cobrancasAPISend', 'CobrancasAPIController@cobrancasAPISend')->name('cobrancasAPI.cobrancasAPISend');

//RN-0002
Route::any('/cobrancasAPIMsg', 'CobrancasAPIController@cobrancasAPIMsg')->name('cobrancasAPI.cobrancasAPIMsg');
Route::any('/cobrancasAPIMsgBoleto', 'CobrancasAPIController@cobrancasAPIMsgBoleto')->name('cobrancasAPI.cobrancasAPIMsgBoleto');
Route::any('/inadimplentes', 'CobrancasAPIController@inadimplentes')->name('cobrancasAPI.inadimplentes');

Route::any('/logMikrotik', 'SyslogAPIController@logMikrotik')->name('logMikrotik');






//Route::any('/enableDisableSecret', 'NotificationUrl@notificationUrl')->name('notificationUrl');



Route::group(
    [
        'prefix' => 'mikrotik',
    ], function () {

    Route::POST('/enableDisableSecret/{id}', 'MikrotikController@enableDisableSecret')
        ->name('mikrotik.enableDisableSecret');

    Route::get('/clientesPorMes','MikrotikController@clientesPorMes')
        ->name('mikrotik.clientesPorMes');

    Route::get('/activeDesactiveClients','MikrotikController@activeDesactiveClients')
        ->name('mikrotik.activeDesactiveClients');
});

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
        'prefix' => 'mikrotikMonitor',
    ], function () {

    Route::get('/pppoeStatus', 'MikrotikMonitorController@pppoeStatus')
        ->name('mikrotikMonitor.pppoeStatus');

    Route::get('/', 'MikrotikMonitorController@index')
        ->name('mikrotikMonitor.index');
});


Route::group(
    [
        'prefix' => 'inadimplente',
    ], function () {

    Route::get('/grid', 'DebitosController@inadimplentes')
        ->name('inadimplentes.index');
    Route::get('/', 'DebitosController@inadimplentesIndex')
        ->name('inadimplentes.index');


});


Route::group(
    [
        'prefix' => 'paidDay',
    ], function () {

    Route::get('/grid', 'DebitosController@paidDay')
        ->name('paidDay.grid');
    Route::get('/', 'DebitosController@paidDayIndex')
        ->name('paidDay.index');


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


});

Route::group(
[
    'prefix' => 'router',
], function () {

    Route::get('/', 'RouterController@index')
         ->name('router.router.index');

    Route::get('/create','RouterController@create')
         ->name('router.router.create');

    Route::get('/grid', 'RouterController@grid')
         ->name('router.router.grid');

    Route::get('/show/{router}','RouterController@show')
         ->name('router.router.show')
         ->where('id', '[0-9]+');

    Route::get('/{router}/edit','RouterController@edit')
         ->name('router.router.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'RouterController@store')
         ->name('router.router.store');
               
    Route::put('router/{router}', 'RouterController@update')
         ->name('router.router.update')
         ->where('id', '[0-9]+');

    Route::delete('/{router}/destroy','RouterController@destroy')
         ->name('router.router.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'profile',
], function () {

    Route::get('/', 'ProfileController@index')
         ->name('profile.profile.index');

    Route::get('/create','ProfileController@create')
         ->name('profile.profile.create');

    Route::get('/grid', 'ProfileController@grid')
         ->name('profile.profile.grid');

    Route::get('/show/{profile}','ProfileController@show')
         ->name('profile.profile.show')
         ->where('id', '[0-9]+');

    Route::get('/{profile}/edit','ProfileController@edit')
         ->name('profile.profile.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ProfileController@store')
         ->name('profile.profile.store');
               
    Route::put('profile/{profile}', 'ProfileController@update')
         ->name('profile.profile.update')
         ->where('id', '[0-9]+');

    Route::delete('/{profile}/destroy','ProfileController@destroy')
         ->name('profile.profile.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'pool',
], function () {

    Route::get('/', 'PoolController@index')
         ->name('pool.pool.index');

    Route::get('/create','PoolController@create')
         ->name('pool.pool.create');

    Route::get('/grid', 'PoolController@grid')
         ->name('pool.pool.grid');

    Route::get('/show/{pool}','PoolController@show')
         ->name('pool.pool.show')
         ->where('id', '[0-9]+');

    Route::get('/{pool}/edit','PoolController@edit')
         ->name('pool.pool.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'PoolController@store')
         ->name('pool.pool.store');
               
    Route::put('pool/{pool}', 'PoolController@update')
         ->name('pool.pool.update')
         ->where('id', '[0-9]+');

    Route::delete('/{pool}/destroy','PoolController@destroy')
         ->name('pool.pool.destroy')
         ->where('id', '[0-9]+');

});


Route::group(
[
    'prefix' => 'router',
], function () {

    Route::get('/', 'RouterController@index')
         ->name('router.router.index');

    Route::get('/create','RouterController@create')
         ->name('router.router.create');

    Route::get('/grid', 'RouterController@grid')
         ->name('router.router.grid');

    Route::get('/show/{router}','RouterController@show')
         ->name('router.router.show')
         ->where('id', '[0-9]+');

    Route::get('/{router}/edit','RouterController@edit')
         ->name('router.router.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'RouterController@store')
         ->name('router.router.store');
               
    Route::put('router/{router}', 'RouterController@update')
         ->name('router.router.update')
         ->where('id', '[0-9]+');

    Route::delete('/{router}/destroy','RouterController@destroy')
         ->name('router.router.destroy')
         ->where('id', '[0-9]+');

});




Route::group(
[
    'prefix' => 'profile',
], function () {

    Route::get('/', 'ProfileController@index')
         ->name('profile.profile.index');

    Route::get('/create','ProfileController@create')
         ->name('profile.profile.create');

    Route::get('/grid', 'ProfileController@grid')
         ->name('profile.profile.grid');

    Route::get('/show/{profile}','ProfileController@show')
         ->name('profile.profile.show')
         ->where('id', '[0-9]+');

    Route::get('/{profile}/edit','ProfileController@edit')
         ->name('profile.profile.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ProfileController@store')
         ->name('profile.profile.store');
               
    Route::put('profile/{profile}', 'ProfileController@update')
         ->name('profile.profile.update')
         ->where('id', '[0-9]+');

    Route::delete('/{profile}/destroy','ProfileController@destroy')
         ->name('profile.profile.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'test',
], function () {

    Route::get('/', 'TestController@index')
         ->name('test.test.index');

    Route::get('/create','TestController@create')
         ->name('test.test.create');

    Route::get('/grid', 'TestController@grid')
         ->name('test.test.grid');

    Route::get('/show/{test}','TestController@show')
         ->name('test.test.show')
         ->where('id', '[0-9]+');

    Route::get('/{test}/edit','TestController@edit')
         ->name('test.test.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'TestController@store')
         ->name('test.test.store');
               
    Route::put('test/{test}', 'TestController@update')
         ->name('test.test.update')
         ->where('id', '[0-9]+');

    Route::delete('/{test}/destroy','TestController@destroy')
         ->name('test.test.destroy')
         ->where('id', '[0-9]+');

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
    'prefix' => 'grupo',
], function () {

    Route::get('/', 'GrupoController@index')
         ->name('grupo.grupo.index');

    Route::get('/create','GrupoController@create')
         ->name('grupo.grupo.create');

    Route::get('/grid', 'GrupoController@grid')
         ->name('grupo.grupo.grid');

    Route::get('/show/{grupo}','GrupoController@show')
         ->name('grupo.grupo.show')
         ->where('id', '[0-9]+');

    Route::get('/{grupo}/edit','GrupoController@edit')
         ->name('grupo.grupo.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'GrupoController@store')
         ->name('grupo.grupo.store');
               
    Route::put('grupo/{grupo}', 'GrupoController@update')
         ->name('grupo.grupo.update')
         ->where('id', '[0-9]+');

    Route::delete('/{grupo}/destroy','GrupoController@destroy')
         ->name('grupo.grupo.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'debitos',
], function () {

    Route::get('/', 'DebitosController@index')
         ->name('debitos.debitos.index');

    Route::get('/create','DebitosController@create')
         ->name('debitos.debitos.create');

    Route::get('/grid', 'DebitosController@grid')
         ->name('debitos.debitos.grid');

    Route::get('/modalGrid', 'DebitosController@modalgrid')
        ->name('debitos.debitos.modalgrid');

    Route::get('/show/{debitos}','DebitosController@show')
         ->name('debitos.debitos.show')
         ->where('id', '[0-9]+');

    Route::get('/{debitos}/edit','DebitosController@edit')
         ->name('debitos.debitos.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'DebitosController@store')
         ->name('debitos.debitos.store');

    Route::post('/baixa', 'DebitosController@debitoBaixa')
        ->name('debito.baixa');

    Route::get('/cancelCharge/{code}', 'DebitosController@cancelCharge')
        ->name('debitos.cancelCharge');


    Route::get('/knob', 'DebitosController@knob')
        ->name('debitos.debitos.knob');
               
    Route::put('debitos/{debitos}', 'DebitosController@update')
         ->name('debitos.debitos.update')
         ->where('id', '[0-9]+');

    Route::delete('/{debitos}/destroy','DebitosController@destroy')
         ->name('debitos.debitos.destroy')
         ->where('id', '[0-9]+');


});

Route::group(
[
    'prefix' => 'cobranca',
], function () {

    Route::get('/', 'CobrancaController@index')
         ->name('cobranca.cobranca.index');

    Route::get('/create','CobrancaController@create')
         ->name('cobranca.cobranca.create');

    Route::get('/grid', 'CobrancaController@grid')
         ->name('[% grid_route_name %]');

    Route::get('/show/{cobranca}','CobrancaController@show')
         ->name('cobranca.cobranca.show')
         ->where('id', '[0-9]+');

    Route::get('/{cobranca}/edit','CobrancaController@edit')
         ->name('cobranca.cobranca.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'CobrancaController@store')
         ->name('cobranca.cobranca.store');
               
    Route::put('cobranca/{cobranca}', 'CobrancaController@update')
         ->name('cobranca.cobranca.update')
         ->where('id', '[0-9]+');

    Route::delete('/{cobranca}/destroy','CobrancaController@destroy')
         ->name('cobranca.cobranca.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'log',
], function () {

    Route::get('/', 'LogController@index')
         ->name('log.log.index');

    Route::get('/create','LogController@create')
         ->name('log.log.create');

    Route::get('/grid', 'LogController@grid')
         ->name('[% grid_route_name %]');

    Route::get('/show/{log}','LogController@show')
         ->name('log.log.show')
         ->where('id', '[0-9]+');

    Route::get('/{log}/edit','LogController@edit')
         ->name('log.log.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'LogController@store')
         ->name('log.log.store');
               
    Route::put('log/{log}', 'LogController@update')
         ->name('log.log.update')
         ->where('id', '[0-9]+');

    Route::delete('/{log}/destroy','LogController@destroy')
         ->name('log.log.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'projeto'
],  function () {

    Route::get('/', 'ProjetoController@index')
         ->name('projeto.projeto.index');

    Route::get('/create','ProjetoController@create')
         ->name('projeto.projeto.create');

    Route::get('/grid', 'ProjetoController@grid')
         ->name('[% grid_route_name %]');

    Route::get('/show/{projeto}','ProjetoController@show')
         ->name('projeto.projeto.show')
         ->where('id', '[0-9]+');

    Route::get('/{projeto}/edit','ProjetoController@edit')
         ->name('projeto.projeto.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ProjetoController@store')
         ->name('projeto.projeto.store');
               
    Route::put('projeto/{projeto}', 'ProjetoController@update')
         ->name('projeto.projeto.update')
         ->where('id', '[0-9]+');

    Route::delete('/{projeto}/destroy','ProjetoController@destroy')
         ->name('projeto.projeto.destroy')
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
