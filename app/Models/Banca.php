<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProfExterno;
use App\Models\Agendamento;

class Banca extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }

    public function prof_externo()
    {
        return $this->belongsTo(ProfExterno::class);
    }

    public function dump($id){
        return Agendamento::dadosProfExterno($id);
    }
    
}
