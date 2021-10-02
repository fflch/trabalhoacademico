<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;
use Illuminate\Support\Facades\Mail;
use App\Mail\BibliotecaMail;
use Uspdev\Replicado\Pessoa;

class BibliotecaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $agendamento;
    public $codpes;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Agendamento $agendamento, $codpes)
    {
        $this->agendamento = $agendamento;
        $this->codpes = $codpes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(Pessoa::emailusp($this->codpes) != false){
            Mail::send(new BibliotecaMail($this->agendamento, $this->codpes));
        }
    }
}
