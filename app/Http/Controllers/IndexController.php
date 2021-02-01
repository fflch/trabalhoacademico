<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Uspdev\Replicado\Pessoa;
use Auth;
use App\Models\Agendamento;

class IndexController extends Controller
{
    public function dashboard(Request $request){
        if(Pessoa::cracha(Auth::user()->codpes)['tipvinaux'] == 'ALUNOGR'){
            $agendamentos = Agendamento::where('user_id', Auth::user()->id)->get();
        }
        elseif(Pessoa::cracha(Auth::user()->codpes)['tipvinaux'] == 'DOCENTE'){
            $agendamentos = Agendamento::where('numero_usp_do_orientador', Auth::user()->id)->where('status', 'Em Avaliação')->get();
        }
        else{
            return view('welcome');
        }
        return view('index', compact('agendamentos'));
    }
}
