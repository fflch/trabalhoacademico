<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Agendamento extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function bancas()
    {
        return $this->hasMany(Banca::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    //Função para devolver valores de select
    public static function divulgaOptions(){
        return [
            'Sim',
            'Não',
        ];
    }

    public static function statusOptions(){
        return [
            'Em Elaboração',
            'Em Avaliação',
            'Aprovado',
        ];
    }

    //Função para devolver valores de select
    public static function presidenteOptions(){
        return [
            'Sim',
            'Não'
        ];
    }

    public function setDataDaDefesaAttribute($value){
        $this->attributes['data_da_defesa'] = Carbon::CreatefromFormat('d/m/Y', "$value");
    }

}
