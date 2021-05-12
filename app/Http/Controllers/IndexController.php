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
        $query = Agendamento::join('users', 'users.id', '=', 'agendamentos.user_id')->where('agendamentos.status','Em Avaliação')->where('agendamentos.data_da_defesa','>=',date('Y-m-d'))->orderBy('agendamentos.data_da_defesa', 'desc')->select('agendamentos.*'); 
        if($request->busca_curso != ''){
            $query->where('agendamentos.curso',$request->busca_curso);
        }
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

    public function anteriores(Request $request){
        $query = Agendamento::join('users', 'users.id', '=', 'agendamentos.user_id')->where('agendamentos.status','=','Aprovado')->orderBy('agendamentos.data_da_defesa', 'asc')->select('agendamentos.*');
        if($request->busca_curso != ''){
            $query->where('agendamentos.curso',$request->busca_curso);
        }
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
        return view('anteriores')->with('agendamentos',$agendamentos);
    }

    public function dashboard(){
        $this->authorize('LOGADO');
        if(in_array(Auth::user()->codpes,explode(',', trim(env('CODPES_BIBLIOTECA'))))){
            $query = Agendamento::where('status','=','Aprovado')->orderBy('data_da_defesa', 'asc')->select('agendamentos.*');
        }
        elseif(in_array('Docente',Pessoa::vinculosSetores(Auth::user()->codpes,8))){
            $query = Agendamento::where('numero_usp_do_orientador', Auth::user()->codpes)->orderBy('data_da_defesa','asc');
        }
        else{
            $query = Agendamento::where('user_id', Auth::user()->id)->orderBy('data_da_defesa','asc');
        }
        $agendamentos = $query->paginate(20);
        return view('dashboard', compact('agendamentos'));
    }
}
