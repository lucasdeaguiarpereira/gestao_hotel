<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboardClient');
});

// Route::middleware(['auth:sanctum', 'verified'])->apiResource('pacotes','App\Http\Controllers\PacotesController');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/pacotes', function () {
    return view('pacotes');
})->name('pacotes');

Route::middleware(['auth:sanctum', 'verified'])->get('/agendamentos', function () {
    return view('agendamentos');
})->name('agendamentos');

Route::middleware(['auth:sanctum', 'verified'])->get('/usuarios', function () {
    return view('usuarios');
})->name('usuarios');

Route::middleware(['auth:sanctum', 'verified'])->get('/relatorios', function () {
    return view('relatorios');
})->name('relatorios');

Route::middleware(['auth:sanctum', 'verified'])->get('/areadeemails', function () {
    return view('areadeemails');
})->name('areadeemails');


