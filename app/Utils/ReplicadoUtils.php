<?php

namespace App\Utils;
use Uspdev\Replicado\DB as DBreplicado;
use Uspdev\Replicado\Uteis;
use Uspdev\Replicado\Graduacao;

class ReplicadoUtils {

    public static function listarDocentes(){
        $unidade = getenv('REPLICADO_CODUNDCLG');
        $query = "SELECT DISTINCT l.codpes, l.nompes from LOCALIZAPESSOA l where l.tipvinext LIKE '%Docente%' and l.codundclg = {$unidade} ORDER BY l.nompes";
        return DBreplicado::fetchAll($query);
    }

    public static function nomeSetorAluno($codpes){
        $codundclg = intval(getenv('REPLICADO_CODUNDCLG'));
        $sigla_setor = Graduacao::setorAluno($codpes,$codundclg)['nomabvset'];

        if($sigla_setor == 'DEPARTAMENTO NÃO ENCONTRADO') return '';

        $query = "SELECT S.codset, S.tipset, S.nomabvset, S.nomset, S.codsetspe FROM SETOR S";
        $query .= " WHERE S.codund = {$codundclg} AND S.nomabvset = '{$sigla_setor}'";
        $query .= " AND S.tipset = 'Departamento de Ensino'";

        $result = DBreplicado::fetchAll($query);

        if($result == []) return '';

        return $result;
    }
} 