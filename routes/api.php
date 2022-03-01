<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::apiResource('users','App\Http\Controllers\UsersController');
Route::apiResource('agendamentos','App\Http\Controllers\AgendamentosController');
Route::apiResource('enderecosusuarios','App\Http\Controllers\EnderecosUsuariosController');
Route::apiResource('pacotes','App\Http\Controllers\PacotesController');
Route::apiResource('pesquisassatisfacao','App\Http\Controllers\PesquisasSatisfacaoController');
Route::apiResource('precos','App\Http\Controllers\PrecosController');
Route::apiResource('tiposusuarios','App\Http\Controllers\TiposUsuariosController');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/imagemPacote', 'App\Http\Controllers\PacotesController@salvarImagem');
Route::get('/precoValido/{idAgendamento}', 'App\Http\Controllers\PrecosController@getPrecoValido');
Route::get('/faturamentoTotal/{dataInicial}/{dataFinal}', 'App\Http\Controllers\RelatoriosController@getFaturamentoTotal');

Route::post('/enviarEmail','App\Http\Controllers\EmailController@getEmail');

