<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Agendamento;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailEnvioCorrecaoRemember;

class RememberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $agendamentos = Agendamento::where('status','Aprovado C/ Correções')->get();
        foreach($agendamentos as $agendamento){
            $dias = Carbon::now()->diff($agendamento->data_da_defesa)->days;
            if($dias <= 60) {
                Mail::queue(new MailEnvioCorrecaoRemember($agendamento, $dias));
            }
        }    
    }
}