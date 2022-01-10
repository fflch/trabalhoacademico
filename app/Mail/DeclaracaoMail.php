<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;
use App\Models\Banca;
use App\Models\ProfExterno;
use App\Models\File;
use App\Models\Config;
use Uspdev\Replicado\Pessoa;
use PDF;

class DeclaracaoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agendamento $agendamento, Banca $professor)
    {   
        $this->agendamento = $agendamento;
        $this->professor = $professor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Declaração de Participação da Defesa de {$this->agendamento->user->name}";
        //Busca as informações necessárias para gerar o convite que será anexado
        $professores = Banca::where('agendamento_id',$this->agendamento->id)->orderBy('presidente','desc')->get();
        //Verifica, caso seja professor externo, para alterar a variável a ser usada no pdf
        $agendamento = $this->agendamento;
        if($this->professor->prof_externo_id != null){
            $professor = $this->professor->prof_externo;
            $configs = Config::configDeclaracao($this->agendamento, $this->agendamento->user->name, $this->professor->prof_externo->nome);
            $pdf = PDF::loadView("pdfs.documentos_bancas.declaracao", compact(['agendamento','professores','professor','configs']));
            if($this->professor->prof_externo->email != null){
                return $this->view('emails.declaracao')
                ->to($this->professor->prof_externo->email)
                ->subject($subject)
                ->attachData($pdf->output(), $this->professor->prof_externo->nome.".pdf")
                ->with([
                    'agendamento' => $this->agendamento,
                    'professor' => $this->professor->prof_externo,
                ]);    
            }
        }
        elseif($this->professor->n_usp != null){
            $professor = $this->professor;
            $configs = Config::configDeclaracao($this->agendamento, $this->agendamento->user->name, Pessoa::dump($this->professor->n_usp)['nompes']);
            $pdf = PDF::loadView("pdfs.documentos_bancas.declaracao", compact(['agendamento','professores','professor','configs']));
            if(Pessoa::retornarEmailUsp($this->professor->n_usp) != null){
                return $this->view('emails.declaracao')
                    ->to(Pessoa::retornarEmailUsp($this->professor->n_usp))
                    ->subject($subject)
                    ->attachData($pdf->output(), Pessoa::dump($this->professor->n_usp)['nompes'].".pdf")
                    ->with([
                        'agendamento' => $this->agendamento,
                        'professor' => $this->professor,
                    ]);    
            }
        }
    }
}
