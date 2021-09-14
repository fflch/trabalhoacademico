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

# use App\Mail\EmailRemember;

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
        /*
        $agendamentos = Agendamento::where('ping_status','Down')->get();
        foreach($agendamentos as $agendamento)
        if(XXX) {
            Mail::queue(new EmailPingDownRemember($equipamentos));
        }
        */
        
    }
}