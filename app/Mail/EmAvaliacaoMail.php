<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;
use Uspdev\Replicado\Pessoa;

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

        return $this->view('emails.em_avaliacao')
        ->to(Pessoa::emailusp($this->agendamento->numero_usp_do_orientador))
        ->subject($subject)
        ->with([
            'agendamento' => $this->agendamento,
        ]);
    }
}
