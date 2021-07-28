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
        $codundclgi = getenv('REPLICADO_CODUNDCLG');
        $query = " SELECT L.codpes, L.nompes, C.codcur, C.nomcur, H.codhab, H.nomhab, V.dtainivin, V.codcurgrd";
        $query .= " FROM LOCALIZAPESSOA L";
        $query .= " INNER JOIN VINCULOPESSOAUSP V ON (L.codpes = V.codpes)";
        $query .= " INNER JOIN CURSOGR C ON (V.codcurgrd = C.codcur)";
        $query .= " INNER JOIN HABILITACAOGR H ON (H.codhab = V.codhab)";
        $query .= " WHERE (L.codpes = convert(int,:codpes))";
        $query .= " AND (L.tipvin = 'ALUNOGR' AND L.codundclg = convert(int,:codundclgi))";
        $query .= " AND (V.codcurgrd = H.codcur AND V.codhab = H.codhab)";
        $param = [
            'codpes' => $codpes,
            'codundclgi' => $codundclgi,
        ];
        return DBreplicado::fetchAll($query, $param);
    }



} 