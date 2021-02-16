<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agendamento;
use App\Models\Banca;

class ProfExterno extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bancas()
    {
        return $this->belongsTo(Banca::class);
    }

    public function getBancasProfessor($id, $tipo){
        $agendamentos = [];
        $bancas = Banca::where('prof_externo_id', $id)->where('presidente','Não')->get();
        foreach($bancas as $banca){
            $agendamentos[] = Agendamento::where('id', $banca->agendamento_id)->orderBy('data_da_defesa','asc')->get()->toArray();
        }
        return $agendamentos;
    }
}
