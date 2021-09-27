<?php

namespace App\Services;

use Axn\LaravelStepper\Stepper;
use App\Models\Agendamento;

class AgendamentoStepper extends Stepper
{
    protected $view = 'laravel-fflch-stepper::main';
    
    public function register()
    {
        foreach(Agendamento::status as $status){
            $this->addStep($status);
        }
    }
}