<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;
use App\Models\File;
use Uspdev\Replicado\Pessoa;
use Illuminate\Support\Facades\URL;

class EmAvaliacaoMail extends Mailable
{
    use Queueable, SerializesModels;
    private $agendamento;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agendamento $agendamento)
    {   
        $this->agendamento = $agendamento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Novo trabalho acadêmico de {$this->agendamento->user->name} para ser avaliado";
        $url = URL::temporarySignedRoute('acesso_autorizado', now()->addMinutes(43200), [
            'file_id'   => $this->agendamento->files()->first()->id,
            'agendamento_id' => $this->agendamento->id,
        ]);        
        return $this->view('emails.em_avaliacao')
        ->to(Pessoa::emailusp($this->agendamento->numero_usp_do_orientador))
        ->subject($subject)
        ->with([
            'agendamento' => $this->agendamento,
            'url' => $url,
        ]);
    }
}
