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
        $query = Agendamento::join('users', 'users.id', '=', 'agendamentos.user_id')->where('agendamentos.status','=','Aprovado')->orderBy('agendamentos.data_da_defesa', 'desc')->select('agendamentos.*'); 
        if($request->busca != ''){
            $query->where(function($query) use($request){
                $query->orWhere('users.name', 'LIKE', "%$request->busca%");
                $query->orWhere('agendamentos.nome_do_orientador', 'LIKE', "%$request->busca%");
                $query->orWhere('agendamentos.titulo', 'LIKE', "%$request->busca%");
            });
        }
        $agendamentos = $query->paginate(20);
        if ($agendamentos->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('index', compact('agendamentos'));
    }

    public function dashboard(){
        if(in_array('Aluno de Graduação',Pessoa::vinculosSetores(Auth::user()->codpes, 8))){
            $agendamentos = Agendamento::where('user_id', Auth::user()->id)->orderBy('data_da_defesa','asc')->get();
        }
        elseif(in_array('Docente',Pessoa::vinculosSetores(Auth::user()->codpes,8))){
            $agendamentos = Agendamento::where('numero_usp_do_orientador', Auth::user()->codpes)->where('status', 'Em Avaliação')->orderBy('data_da_defesa','asc')->get();
        }
        else{
            $agendamentos = Agendamento::orderBy('data_da_defesa', 'desc')->where('status','Aprovado')->paginate(20); 
            return view('index', compact('agendamentos'));
        }
        return view('dashboard', compact('agendamentos'));
    }
}
