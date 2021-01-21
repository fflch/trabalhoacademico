<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function bancas()
    {
        return $this->hasMany(Banca::class);
    }

    //Função para devolver valores de select
    public static function divulgaOptions(){
        return [
            'Sim',
            'Não',
        ];
    }
}
