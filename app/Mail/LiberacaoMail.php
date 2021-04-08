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

class LiberacaoMail extends Mailable
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
        $subject = "Agendamento da Defesa de {$this->agendamento->user->name}";
        //Busca o arquivo do trabalho para enviar por anexo
        $file = File::where('agendamento_id',$this->agendamento->id)->first();
        //Busca as informações necessárias para gerar o convite que será anexado
        $configs = Config::orderbyDesc('created_at')->first();
        $professores = Banca::where('agendamento_id',$this->agendamento->id)->orderBy('presidente','desc')->get();
        //Verifica, caso seja professor externo, para alterar a variável a ser usada no pdf
        $agendamento = $this->agendamento;
        if($this->professor->prof_externo != null){
            $professor = $this->professor->prof_externo;
        }
        else{
            $professor = $this->professor;
        }
        $pdf = PDF::loadView("pdfs.documentos_bancas.oficio", compact(['agendamento','professores','professor','configs']));
    
        if(Pessoa::emailusp($this->professor->n_usp) != false){
            return $this->view('emails.liberacao')
                ->to(Pessoa::emailusp($this->professor->n_usp))
                ->subject($subject)
                ->attachFromStorage($file->path, $file->original_name, [
                    'mime' => 'application/pdf',
                ])
                ->attachData($pdf->output(), Pessoa::dump($this->professor->n_usp)['nompes'].".pdf")
                ->with([
                    'agendamento' => $this->agendamento,
                    'professor' => $this->professor,
                ]);    
        }
        if($this->professor->prof_externo->email != null){
            return $this->view('emails.liberacao')
            ->to($this->professor->prof_externo->email)
            ->subject($subject)
            ->attachFromStorage($file->path, $file->original_name, [
                'mime' => 'application/pdf',
            ])
            ->attachData($pdf->output(), $this->professor->prof_externo->nome.".pdf")
            ->with([
                'agendamento' => $this->agendamento,
                'professor' => $this->professor->prof_externo,
            ]);    
        }  
    }
}
