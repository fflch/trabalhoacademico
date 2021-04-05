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
use App\Models\ProfExterno;
use Illuminate\Support\Facades\Mail;
use App\Mail\LiberacaoMail;

class LiberacaoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $agendamento;
    public $professor;
    public $prof_externo;
    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->professor != null){
            Mail::send(new LiberacaoMail($this->agendamento, $this->professor, null));    
        }
        elseif($this->prof_externo != null){
            Mail::send(new LiberacaoMail($this->agendamento, null, $this->prof_externo));    
        }  
    }
}
