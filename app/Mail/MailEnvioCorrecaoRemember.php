<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;
use Uspdev\Replicado\Pessoa;

class MailEnvioCorrecaoRemember extends Mailable
{
    use Queueable, SerializesModels;
    private $agendamento;
    private $dias;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agendamento $agendamento, $dias)
    {   
        $this->agendamento = $agendamento;
        $this->dias = $dias;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Prazo para envio da correção do TGI - {$this->agendamento->user->name}";

        return $this->view('emails.envio_correcao_remember')
        ->to(Pessoa::retornarEmailUsp($this->agendamento->user->codpes))
        ->subject($subject)
        ->with([
            'agendamento' => $this->agendamento,
            'dias' => $this->dias,
        ]);
    }
}
