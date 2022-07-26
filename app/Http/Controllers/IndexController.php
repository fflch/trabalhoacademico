<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Uspdev\Replicado\Pessoa;
use App\Models\Agendamento;
use App\Models\User;
use App\Utils\ReplicadoUtils;

class IndexController extends Controller
{
    public function index(Request $request){
        if(Auth::check()) return $this->dashboard();

        return $this->agendamentos($request);
    }

    public function agendamentos(Request $request){
        $query = Agendamento::join('users', 'users.id', '=', 'agendamentos.user_id')->orderBy('agendamentos.data_da_defesa', 'desc')->select('agendamentos.*'); 
        $curso = Agendamento::select('curso')->whereNotNull('curso')->distinct();
        if($request->busca_curso != ''){
            $query->where('agendamentos.curso',$request->busca_curso);
        }
        if($request->busca_status != ''){
            if($request->busca_status == 'Publicado'){
                $query->where('agendamentos.publicado', 'Sim');
                $curso->where('publicado', 'Sim');
            }
            else{
                $query->where('agendamentos.status','LIKE', "%$request->busca_status%");
                $curso->where('status','LIKE', "%$request->busca_status%");
            }
        }
        else{
            $query->where('agendamentos.status','Em Avaliação');
            $curso->where('status','Em Avaliação');
        }
        if($request->busca != ''){
            $query->where(function($query) use($request){
                $query->orWhere('users.name', 'LIKE', "%$request->busca%");
                $query->orWhere('agendamentos.nome_do_orientador', 'LIKE', "%$request->busca%");
                $query->orWhere('agendamentos.titulo', 'LIKE', "%$request->busca%");
            });
        }
        
        $agendamentos = $query->paginate(20);
        $cursoOptions = $curso->get();
        if ($agendamentos->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('index', compact('agendamentos','cursoOptions'));
    }

    public function dashboard(){

        $this->authorize('logado');
        if(in_array(Auth::user()->codpes,explode(',', trim(env('CODPES_BIBLIOTECA'))))){
            $query = Agendamento::where('status','=','Aprovado')->orderBy('data_da_defesa', 'asc')->select('agendamentos.*');
        }
        elseif(ReplicadoUtils::isDocente(Auth::user()->codpes)){
            $query = Agendamento::where('numero_usp_do_orientador', Auth::user()->codpes)->orderBy('data_da_defesa','asc');
        }
        else{
            $query = Agendamento::where('user_id', Auth::user()->id)->orderBy('data_da_defesa','asc');
        }
        $agendamentos = $query->paginate(20);
        return view('index', compact('agendamentos'));
    }
}
