<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Agendamento;
use App\Models\Docente;
use App\Models\Banca;
use App\Models\Config;
use Carbon\Carbon;
use Uspdev\Replicado\Pessoa;
use App\Utils\ReplicadoUtils;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Bloco destinado aos documentos gerais
    public function documentosGerais(Agendamento $agendamento, $tipo){
        $this->authorize('logado');
        $configs = Config::orderbyDesc('created_at')->first();
        $agendamento->departamento = ReplicadoUtils::nomeSetorAluno($agendamento->user->codpes)[0]['nomset'];
        if($agendamento->departamento == '') $agendamento->departamento = $agendamento->curso;
        if($tipo == 'placa'){
            $pdf = PDF::loadView('pdfs.documentos_gerais.placa', compact('agendamento'))->setPaper('a4', 'landscape');
            return $pdf->download('placa.pdf');
        }

        $professores = Banca::where('agendamento_id',$agendamento->id)->orderBy('presidente','desc')->get();
        $bancas = $professores;

        config(['laravel-fflch-pdf.setor' => "Departamento de $agendamento->departamento"]);
        $pdf = PDF::loadView("pdfs.documentos_gerais.$tipo", compact(['agendamento','professores','bancas','configs']));
        return $pdf->download("$tipo.pdf");
    }

    //Bloco destinado aos documentos individuais
    public function documentosIndividuais(Agendamento $agendamento, Banca $banca, $tipo){
        $this->authorize('logado');
        $professores = Banca::where('agendamento_id',$agendamento->id)->orderBy('presidente','desc')->get();
        $professor = $banca;
        $agendamento->departamento = ReplicadoUtils::nomeSetorAluno($agendamento->user->codpes)[0]['nomset'];
        if($agendamento->departamento == '') $agendamento->departamento = $agendamento->curso;
        config(['laravel-fflch-pdf.setor' => "Departamento de $agendamento->departamento"]);
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
