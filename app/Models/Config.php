<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agendamento;
use Uspdev\Replicado\Pessoa;
use Uspdev\Replicado\Graduacao;

class Config extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    //Função para modificar a mensagem padrão da Declaração
    public static function configDeclaracao($agendamento, $nome, $professor){
        //Busca a última configuração
        $configs = Config::orderbyDesc('created_at')->first();
        $configs['declaracao'] = str_replace(
            ["%docente_nome","%candidato_nome", "%titulo", "%area", "%orientador"], 
            [$professor['nome'], $nome, $agendamento['titulo'], Graduacao::curso($agendamento->user->codpes,getenv('REPLICADO_CODUNDCLG'))['nomcur'], $agendamento['nome_do_orientador']], 
            $configs['declaracao']
        );
        return $configs;
    }
}
