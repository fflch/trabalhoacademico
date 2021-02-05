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
            $professores = Banca::where('agendamento_id',$agendamento->id)->get();
            $bancas = $professores;
            $pdf = PDF::loadView("pdfs.documentos_gerais.$tipo", compact(['agendamento','professores','bancas','configs']));
            return $pdf->download("$tipo.pdf");
        }
    }

    //Bloco destinado aos documentos individuais
    public function documentosIndividuais(Agendamento $agendamento, Banca $banca, $tipo){
        $this->authorize('LOGADO');
        $professores = Banca::where('agendamento_id',$agendamento->id)->get();
        $professor = $banca;
        if($tipo == 'declaracao'){
            $configs = Config::configDeclaracao($agendamento,$agendamento->user->name, $professor);
        }
        elseif($tipo == 'oficio'){
            $configs = Config::orderbyDesc('created_at')->first();
        }
        $pdf = PDF::loadView("pdfs.documentos_bancas.$tipo", compact(['agendamento','professores','professor','configs']));
        if($banca->nome == null){
            $nome = 'Professor';
        }
        else{
            $nome = $banca->nome;
        }
        return $pdf->download("$nome - $tipo.pdf");
        
    }

}
