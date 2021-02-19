<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agendamento;
use Uspdev\Replicado\Pessoa;
use Uspdev\Replicado\Graduacao;
use Carbon\Carbon;

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
            [$professor, $nome, $agendamento['titulo'], Graduacao::curso($agendamento->user->codpes,getenv('REPLICADO_CODUNDCLG'))['nomcur'], $agendamento['nome_do_orientador']], 
            $configs['declaracao']
        );
        return $configs;
    }

    public static function configRodape($curso){
        //Busca a última configuração
        $configs = Config::orderbyDesc('created_at')->first();
        $configs['rodape_oficios'] = str_replace(
            ["%departamento"], 
            [$curso], 
            $configs['rodape_oficios']
        );
        if($curso == 'Filosofia' or $curso == 'Ciências Sociais'){
            $configs['rodape_oficios'] = str_replace(
                ["%endereco"], 
                [' Av. Prof. Luciano Gualberto, 315 | Cidade Universitária | São Paulo-SP | CEP 05508-010'], 
                $configs['rodape_oficios']
            );
        }
        elseif($curso == 'Geografia' or $curso == 'História'){
            $configs['rodape_oficios'] = str_replace(
                ["%endereco"], 
                ['Av. Prof. Lineu Prestes, 338 | Cidade Universitária | São Paulo-SP | CEP 05508-000'], 
                $configs['rodape_oficios']
            );
        }
        elseif($curso == 'Letras'){
            $configs['rodape_oficios'] = str_replace(
                ["%endereco"], 
                ['Av. Prof. Luciano Gualberto, 403 | Cidade Universitária | São Paulo-SP | CEP 05508-010'], 
                $configs['rodape_oficios']
            );
        }
        return $configs;
    }

    public static function configMailEmAvaliacao($agendamento, $nome, $professor){
        //Busca a última configuração
        $configs = Config::orderbyDesc('created_at')->first();
        $configs['mail_avaliacao'] = str_replace(
            ["%docente_nome","%candidato_nome", "%titulo", "%agendamento_id", "%data_defesa", "%agendamento_email"], 
            [$professor, $nome, $agendamento->titulo, $agendamento->id, Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y') , $agendamento->user->email], 
            $configs['mail_avaliacao']
        );
        return $configs;
    }

    public static function configMailLiberacao($agendamento, $nome, $professor){
        //Busca a última configuração
        $configs = Config::orderbyDesc('created_at')->first();
        $configs['mail_liberacao'] = str_replace(
            ["%docente_nome","%candidato_nome", "%orientador", "%titulo", "%data_defesa"], 
            [$professor, $nome, $agendamento->nome_do_orientador, $agendamento->titulo, Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y')], 
            $configs['mail_liberacao']
        );
        return $configs;
    }

    public static function configMailDevolucao($agendamento){
        //Busca a última configuração
        $configs = Config::orderbyDesc('created_at')->first();
        $configs['mail_devolucao'] = str_replace(
            ["%candidato_nome", "%orientador", "%titulo", "%agendamento_id", "%data_defesa", "%status", "%parecer"], 
            [$agendamento->user->name, $agendamento->nome_do_orientador, $agendamento->titulo, $agendamento->id, Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y'), $agendamento->status, $agendamento->parecer], 
            $configs['mail_devolucao']
        );
        return $configs;
    }

    public static function configMailAprovacao($agendamento){
        //Busca a última configuração
        $configs = Config::orderbyDesc('created_at')->first();
        $configs['mail_aprovacao'] = str_replace(
            ["%candidato_nome", "%orientador", "%titulo", "%agendamento_id", "%data_defesa", "%status", "%parecer"], 
            [$agendamento->user->name, $agendamento->nome_do_orientador, $agendamento->titulo, $agendamento->id, Carbon::parse($agendamento->data_da_defesa)->format('d/m/Y'), $agendamento->status, $agendamento->parecer], 
            $configs['mail_aprovacao']
        );
        return $configs;
    }
}
