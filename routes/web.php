<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\BancaController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\ProfExternoController;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/dashboard', [IndexController::class, 'dashboard'])->name('dashboard');
Route::get('login',[LoginController::class, 'redirectToProvider'])->name('login');
Route::get('callback', [LoginController::class, 'handleProviderCallback']);
Route::get('logout',[LoginController::class, 'logout'])->name('logout');


Route::post('agendamentos/enviar_avaliacao/{agendamento}', [AgendamentoController::class,'enviar_avaliacao']);
Route::post('agendamentos/enviar_correcao/{agendamento}', [AgendamentoController::class,'enviar_correcao']);
Route::post('agendamentos/resultado/{agendamento}', [AgendamentoController::class,'resultado']);
Route::post('agendamentos/liberar/{agendamento}', [AgendamentoController::class,'liberar']);
Route::post('agendamentos/publicar/{agendamento}', [AgendamentoController::class,'publicar']);
Route::post('agendamentos/voltar_defesa/{agendamento}', [AgendamentoController::class,'voltar_defesa']);

Route::resource('agendamentos', AgendamentoController::class);
Route::resource('bancas', BancaController::class);
Route::resource('files', FileController::class);
Route::resource('prof_externo', ProfExternoController::class);

// rotas para configs
Route::get('/configs',[ConfigController::class, 'edit']);
Route::post('/configs',[ConfigController::class, 'store']);

// rotas para pdfs
Route::get('/agendamentos/{agendamento}/{tipo}',[PdfController::class, 'documentosGerais']);
Route::get('/agendamentos/{agendamento}/bancas/{banca}/{tipo}',[PdfController::class, 'documentosIndividuais']);

// rotas para login_admin
Route::get('/login_admin',[LoginAdminController::class, 'show']);
Route::post('/login_admin',[LoginAdminController::class, 'login']);

# Logs  
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('can:ADMIN');

//Rotas para link de arquivo temporário
Route::get('acesso/autorizado', [AgendamentoController::class,'acesso_autorizado'])->name('acesso_autorizado');
