<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Uspdev\Replicado\Pessoa;
use Uspdev\Replicado\Graduacao;
use App\Models\User;
use App\Models\ProfExterno;
use App\Utils\ReplicadoUtils;

use Illuminate\Support\Facades\Auth;

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
                "Em Elaboração",
                "Em Avaliação",
                "Aprovado C/ Correções",
                "Aprovado",
                "Reprovado",
        ];
    }

    //Função para devolver valores de select
    public static function presidenteOptions(){
        return [
            'Sim',
            'Não'
        ];
    }

    //Função para devolver valores de select
    public static function tipoOptions(){
        return [
            'Presencial',
            'Virtual',
            'Por Parecer',
        ];
    }

    public function setDataDaDefesaAttribute($value){
        $this->attributes['data_da_defesa'] = Carbon::CreatefromFormat('d/m/Y H:i', "$value");
    }

    public function docentes(){
        return ReplicadoUtils::listarDocentes();
    }

    public function returnLastFileId($value){
        $file = File::where('agendamento_id', $value)->first('id');
        if($file){
            return $file->id;
        }
        return false;
    }

    public function profExterno(){
        return ProfExterno::all()->toArray();
    }

    public static function dadosProfExterno($id){
        return ProfExterno::where('id',$id)->first();
    }

    public static function cursoOptions(){
        return Agendamento::select('curso')->distinct('curso')->get();
    }

    public function setCursoAttribute()
    {
        if($this->curso == null and auth()->user()){
            $this->attributes['curso'] = Graduacao::curso(Auth::user()->codpes,getenv('REPLICADO_CODUNDCLG'))['nomcur'];
        }
        else {
            $this->attributes['curso'] = Graduacao::curso($this->user->codpes,getenv('REPLICADO_CODUNDCLG'))['nomcur'];
        }
    }

    public function setUserIdAttribute()
    {
        if($this->user_id != null){
            $this->attributes['user_id'] = $this->user->id;
        }
        else if(auth()->user()){
                $this->attributes['user_id'] = auth()->user()->id;
        }

        # seeder case
        /*if( config('app.env') == 'local' && config('app.debug')){
            $this->attributes['user_id'] = 1;
        }*/
        
    }

}
