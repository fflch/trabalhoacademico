<?php

namespace App\Utils;
use Uspdev\Replicado\DB as DBreplicado;
use Uspdev\Replicado\Uteis;
use Uspdev\Replicado\Posgraduacao;

class ReplicadoUtils {

    public static function listarDocentes(){
        $unidade = getenv('REPLICADO_CODUNDCLG');
        $query = "SELECT DISTINCT l.codpes, l.nompes from LOCALIZAPESSOA l where l.tipvinext LIKE '%Docente%' and l.codundclg = {$unidade} ORDER BY l.nompes";
        return DBreplicado::fetchAll($query);
    }

} 