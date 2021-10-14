<?php

namespace App\Utils;
use Uspdev\Replicado\DB as DBreplicado;
use Uspdev\Replicado\Uteis;

class ReplicadoUtils {

    public static function listarDocentes(){
        $unidade = getenv('REPLICADO_CODUNDCLG');
        $query = "SELECT DISTINCT l.codpes, l.nompes from LOCALIZAPESSOA l where l.tipvinext LIKE '%Docente%' and l.codundclg = {$unidade} ORDER BY l.nompes";
        return DBreplicado::fetchAll($query);
    }

    /**
     * Método para retornar dados do curso de um aluno na unidade
     *
     * @param Int $codpes
     * @param Int $codundclgi
     * @return array(codpes, nompes, codcur, nomcur, codhab, nomhab, dtainivin, codcurgrd)
     */
    public static function curso($codpes)
    {
        $codclg = getenv('REPLICADO_CODUNDCLG');
        $query = "SELECT DISTINCT C.codcur, C.nomcur";
        $query .= " FROM VINCSATHABILITACAOGR V";
        $query .= " INNER JOIN CURSOGR C ON (V.codcur = C.codcur)";
        $query .= " INNER JOIN HABILITACAOGR H ON (H.codhab = V.codhab)";
        $query .= " WHERE (V.codpes = convert(int,:codpes))";
        $query .= " AND (V.tipvin = 'ALUNOGR' AND C.codclg = convert(int,:codclg))";
        $query .= " AND (V.codcur = H.codcur AND V.codhab = H.codhab)";
        $param = [
            'codpes' => $codpes,
            'codclg' => $codclg,
        ];
        return DBreplicado::fetchAll($query, $param);
    }
} 