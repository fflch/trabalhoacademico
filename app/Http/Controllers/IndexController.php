<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Uspdev\Replicado\Pessoa;
use Auth;
use App\Models\Agendamento;
use App\Models\User;

class IndexController extends Controller
{
    public function index(Request $request){
        $query = Agendamento::orderBy('data_da_defesa', 'desc')->where('status','Aprovado'); 
        $query2 = User::orderBy('name','asc');
        if($request->busca != ''){
            $query2->where('name','LIKE',"%$request->busca%");
            foreach($query2->get() as $user){
                $query->orWhere('user_id',$user->id);
            }          
            $query->orWhere('titulo', 'LIKE', "%$request->busca%");
            $query->orWhere('nome_do_orientador', 'LIKE', "%$request->busca%");
        }
        $agendamentos = $query->paginate(20);
        if ($agendamentos->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('index', compact('agendamentos'));
    }

    public function dashboard(Request $request){
        
        if(Pessoa::cracha(Auth::user()->codpes)['tipvinaux'] == 'ALUNOGR'){
            $agendamentos = Agendamento::where('user_id', Auth::user()->id)->get();
        }
        elseif(Pessoa::cracha(Auth::user()->codpes)['tipvinaux'] == 'DOCENTE'){
            $agendamentos = Agendamento::where('numero_usp_do_orientador', Auth::user()->id)->where('status', 'Em Avaliação')->get();
        }
        else{
            $agendamentos = Agendamento::orderBy('data_da_defesa', 'desc')->where('status','Aprovado')->paginate(20); 
            return view('index', compact('agendamentos'));
        }
        return view('dashboard', compact('agendamentos'));
    }
}
