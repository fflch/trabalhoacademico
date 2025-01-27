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
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Auth;

class Agendamento extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    const status = [
        'Em Elaboração',
        'Em Análise',
        'Em Avaliação',
        'Aprovado C/ Correções',
        'Aprovado',
        'Reprovado',
        'Publicação',
    ];

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

    public function setCursoAttribute($value)
    {
        if(auth()->check() && $value == null) {
            if($this->curso == null and auth()->user()){
                $codpes = Auth::user()->codpes;
            }
            else {
                $codpes = $this->user->codpes;
            }
            $dados_curso = Graduacao::curso($codpes, getenv('REPLICADO_CODUNDCLG'));
            if($dados_curso != false){
                $this->attributes['curso'] = $dados_curso['nomcur'];
            }
            elseif($dados_curso == false && $this->curso == null){
                $this->attributes['curso'] = 'Curso não localizado';
            }
        }
        else{
            # para rodar o seeder
            $this->attributes['curso'] = $value;
        }
    }

    public function setUserIdAttribute($value)
    {
        if(auth()->check()) {
            if($this->user_id != null){
                $this->attributes['user_id'] = $this->user->id;
            }
            else if(auth()->user()){
                    $this->attributes['user_id'] = auth()->user()->id;
            }
        } else {
            # para rodar o seeder
            $this->attributes['user_id'] = $value;
        }
        
    }

    public static function camposCompletos(){
        $agendamento = Schema::getColumnListing('agendamentos');
        $user = Schema::getColumnListing('users');
        $camposAgendamento = array_slice($agendamento, 4);
        $camposUser = [$user[2], $user[1]];
        $camposCompletos = array_merge($camposAgendamento, $camposUser);
        return $camposCompletos;
    }
}
