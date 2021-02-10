<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Uspdev\Replicado\Pessoa;
use App\Models\User;

class Agendamento extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bancas()
    {
        return $this->hasMany(Banca::class)->orderBy('presidente','desc');
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
        $this->attributes['data_da_defesa'] = Carbon::CreatefromFormat('d/m/Y H:i', "$value");
    }

    public function docentes(){
        return Pessoa::listarDocentes();
    }

    public function returnLastFileId($value){
        $file = File::where('agendamento_id', $value)->first('id');
        if($file){
            return $file->id;
        }
        return false;
    }

}
