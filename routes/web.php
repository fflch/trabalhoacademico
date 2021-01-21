<?php

use App\Http\Controllers\indexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\BancaController;

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
// rotas para login/logout
Route::get('/', function () {
    return view('welcome');
});
Route::get('/anteriores',[indexController::class, 'anteriores'])->name('anteriores');
Route::get('login',[LoginController::class, 'redirectToProvider'])->name('login');
Route::get('callback', [LoginController::class, 'handleProviderCallback']);
Route::get('logout',[LoginController::class, 'logout'])->name('logout');


Route::resource('agendamentos', AgendamentoController::class);

// rotas de Banca das Defesas
Route::get('/agendamentos/{agendamento}/bancas/create',[BancaController::class, 'create']);
Route::get('/agendamentos/{agendamento}/bancas/{banca}/edit',[BancaController::class, 'edit']);
Route::patch('/agendamentos/{agendamento}/bancas/{banca}',[BancaController::class, 'update']);
Route::post('/agendamentos/{agendamento}/bancas',[BancaController::class, 'store']);
Route::delete('/agendamentos/{agendamento}/bancas/{banca}',[BancaController::class, 'destroy']);
