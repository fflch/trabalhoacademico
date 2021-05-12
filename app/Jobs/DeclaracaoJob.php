<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;
use App\Models\Banca;
use Illuminate\Support\Facades\Mail;
use App\Mail\DeclaracaoMail;
use Uspdev\Replicado\Pessoa;

class DeclaracaoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $agendamento;
    public $professor;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Agendamento $agendamento, Banca $professor)
    {
        $this->agendamento = $agendamento;
        $this->professor = $professor;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(Pessoa::emailusp($this->professor->n_usp) != false or $this->professor->prof_externo->email != null){
            Mail::send(new DeclaracaoMail($this->agendamento, $this->professor));
        }
    }
}
