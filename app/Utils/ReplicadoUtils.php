<?php

namespace App\Utils;
use Uspdev\Replicado\DB as DBreplicado;
use Uspdev\Replicado\Uteis;
use Uspdev\Replicado\Posgraduacao;

class ReplicadoUtils {

    public static function listarDocentes(){
        $unidade = getenv('REPLICADO_CODUNDCLG');
        $current = date("Y-m-d H:i:s");
        $query = "SELECT DISTINCT l.codpes, l.nompes from LOCALIZAPESSOA l where l.tipvinext LIKE '%Docente%' and l.codundclg = {$unidade} ORDER BY l.nompes";
        $docentes = DBreplicado::fetchAll($query);
        return $docentes;
    }

} 