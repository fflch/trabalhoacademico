<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\BancaController;
use App\Http\Controllers\FileController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [IndexController::class, 'dashboard'])->name('dashboard');
Route::get('login',[LoginController::class, 'redirectToProvider'])->name('login');
Route::get('callback', [LoginController::class, 'handleProviderCallback']);
Route::get('logout',[LoginController::class, 'logout'])->name('logout');


Route::post('agendamentos/enviar_avaliacao/{agendamento}', [AgendamentoController::class,'enviar_avaliacao']);

Route::resource('agendamentos', AgendamentoController::class);
Route::resource('bancas', BancaController::class);
Route::resource('files', FileController::class);

// rotas para configs
Route::get('/configs',[ConfigController::class, 'edit']);
Route::post('/configs',[ConfigController::class, 'store']);