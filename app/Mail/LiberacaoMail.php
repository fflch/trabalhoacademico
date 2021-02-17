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
use Uspdev\Replicado\Pessoa;

class LiberacaoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agendamento $agendamento, Banca $professor = null, ProfExterno $prof_externo = null)
    {   
        $this->agendamento = $agendamento;
        $this->professor = $professor;
        $this->prof_externo = $prof_externo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Agendamento da Defesa de {$this->agendamento->user->name}";
        $file = File::where('agendamento_id',$this->agendamento->id)->first();
        if($this->professor != null){
            if(Pessoa::emailusp($this->professor->n_usp) == null) dd($this->professor->n_usp);
            return $this->view('emails.liberacao')
                ->to(Pessoa::emailusp($this->professor->n_usp))
                ->subject($subject)
                ->attachFromStorage($file->path, $file->original_name, [
                    'mime' => 'application/pdf',
                ])
                ->with([
                    'agendamento' => $this->agendamento,
                    'professor' => $this->professor,
                ]);    
        }
        elseif($this->prof_externo != null){
            return $this->view('emails.liberacao')
            ->to($this->prof_externo->email)
            ->subject($subject)
            ->attachFromStorage($file->path, $file->original_name, [
                'mime' => 'application/pdf',
            ])
            ->with([
                'agendamento' => $this->agendamento,
                'professor' => $this->prof_externo,
            ]);    
        }  
    }
}
