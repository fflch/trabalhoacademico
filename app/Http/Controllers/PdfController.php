<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Agendamento;
use App\Models\Docente;
use App\Models\Banca;
use App\Models\Config;
use Carbon\Carbon;
use App\Utils\ReplicadoUtils;
use Uspdev\Replicado\Pessoa;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Bloco destinado aos documentos gerais
    public function documentosGerais(Agendamento $agendamento, $tipo){
        $this->authorize('LOGADO');
        $configs = Config::orderbyDesc('created_at')->first();
        if($tipo == 'placa'){
            $pdf = PDF::loadView('pdfs.documentos_gerais.placa', compact('agendamento'))->setPaper('a4', 'landscape');
            return $pdf->download('placa.pdf');
        }
        else{
            $professores = Banca::where('agendamento_id',$agendamento->id)->orderBy('presidente','desc')->get();
            $bancas = $professores;
            $pdf = PDF::loadView("pdfs.documentos_gerais.$tipo", compact(['agendamento','professores','bancas','configs']));
            return $pdf->download("$tipo.pdf");
        }
    }

    //Bloco destinado aos documentos individuais
    public function documentosIndividuais(Agendamento $agendamento, Banca $banca, $tipo){
        $this->authorize('LOGADO');
        $professores = Banca::where('agendamento_id',$agendamento->id)->orderBy('presidente','desc')->get();
        $professor = $banca;
        if($tipo == 'declaracao'){
            if($professor->n_usp){
                $configs = Config::configDeclaracao($agendamento, $agendamento->user->name, Pessoa::dump($professor->n_usp)['nompes']);
            }
            elseif($professor->prof_externo_id){
                $configs = Config::configDeclaracao($agendamento, $agendamento->user->name, $professor->prof_externo->nome);
            }
        }
        elseif($tipo == 'oficio'){
            $configs = Config::orderbyDesc('created_at')->first();
        }
        $pdf = PDF::loadView("pdfs.documentos_bancas.$tipo", compact(['agendamento','professores','professor','configs']));
        if($banca->prof_externo_id == null){
            $nome = Pessoa::dump($banca->n_usp)['nompes'];
        }
        else{
            $nome = $banca->prof_externo->nome;
        }
        return $pdf->download("$nome - $tipo.pdf");
        
    }

}
