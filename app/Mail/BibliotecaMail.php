<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;
use Uspdev\Replicado\Pessoa;

class BibliotecaMail extends Mailable
{
    use Queueable, SerializesModels;
    private $agendamento;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Agendamento $agendamento, $servidor)
    {   
        $this->agendamento = $agendamento;
        $this->servidor = $servidor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Novo trabalho acadêmico de {$this->agendamento->user->name} para ser publicado";
        return $this->view('emails.biblioteca')
        ->to(Pessoa::retornarEmailUsp($this->servidor))
        ->subject($subject)
        ->with([
            'agendamento' => $this->agendamento,
        ]);    
    }
}
