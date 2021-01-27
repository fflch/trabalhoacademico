<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;

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
        $subject = 'Trabalaho academico do fulano aguarda avaliaçaõ';

        return $this->view('emails.em_avaliacao')
        ->to('a@com.br')  # email do orientado
        ->subject($subject)
        ->with([
            'agendamento' => $this->agendamento,
        ]);
    }
}
