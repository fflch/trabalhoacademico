<?php

namespace App\Utils;
use Uspdev\Replicado\DB as DBreplicado;
use Uspdev\Replicado\Uteis;
use Uspdev\Replicado\Graduacao;
use Uspdev\Replicado\Pessoa;

class ReplicadoUtils {

    public static function listarDocentes(){
        $unidade = getenv('REPLICADO_CODUNDCLG');
        $query = "SELECT DISTINCT l.codpes, l.nompes from LOCALIZAPESSOA l where l.tipvinext LIKE '%Docente%' and l.codundclg = {$unidade} ORDER BY l.nompes";
        return DBreplicado::fetchAll($query);
    }

    public static function setorAluno($codpes, $codundclgi)
    {
        $codcur = self::curso($codpes, $codundclgi)['codcur'];
        $codhab = self::curso($codpes, $codundclgi)['codhab'];
        $query = " SELECT TOP 1 L.nomabvset FROM CURSOGRCOORDENADOR AS C
                    INNER JOIN LOCALIZAPESSOA AS L ON C.codpesdct = L.codpes
                    WHERE C.codcur = CONVERT(INT, :codcur) AND C.codhab = CONVERT(INT, :codhab)";
        $param = [
            'codcur' => $codcur,
            'codhab' => $codhab,
        ];
        $result = DBreplicado::fetch($query, $param);
        // Nota: Situação a se tratar com log de ocorrências
        // Se o departamento de ensino do alguno de graduação não foi encontrado
        if ($result == false) {
            // Será retornado 'DEPARTAMENTO NÃO ENCONTRADO' a fim de se detectar as situações ATÍPICAS em que isso ocorre
            $result = ['nomabvset' => 'DEPARTAMENTO NÃO ENCONTRADO'];
        }
        return $result;
    }

    public static function curso($codpes, $codundclgi)
    {
        $query = " SELECT L.codpes, L.nompes, C.codcur, C.nomcur, H.codhab, H.nomhab, V.dtainivin, V.codcurgrd";
        $query .= " FROM LOCALIZAPESSOA L";
        $query .= " INNER JOIN VINCULOPESSOAUSP V ON (L.codpes = V.codpes) AND (L.codundclg = V.codclg)";
        $query .= " INNER JOIN CURSOGR C ON (V.codcurgrd = C.codcur)";
        $query .= " INNER JOIN HABILITACAOGR H ON (H.codhab = V.codhab)";
        $query .= " WHERE (L.codpes = convert(int,:codpes))";
        $query .= " AND (L.tipvin = 'ALUNOGR' AND L.codundclg = convert(int,:codundclgi))";
        $query .= " AND (V.codcurgrd = H.codcur AND V.codhab = H.codhab)";
        $param = [
            'codpes' => $codpes,
            'codundclgi' => $codundclgi,
        ];

        $fetch = DBreplicado::fetch($query, $param);

        if($fetch == false){
            $result = [
                'codcur' => '',
                'codhab' => '',
            ];
            return $result;
        }
        return $fetch;
    }

    public static function nomeSetorAluno($codpes){
        $codundclg = intval(getenv('REPLICADO_CODUNDCLG'));
        $sigla_setor = self::setorAluno($codpes,$codundclg)['nomabvset'];

        if($sigla_setor == 'DEPARTAMENTO NÃO ENCONTRADO') return ["0" => ["nomset" => ""]];

        $query = "SELECT S.codset, S.tipset, S.nomabvset, S.nomset, S.codsetspe FROM SETOR S";
        $query .= " WHERE S.codund = {$codundclg} AND S.nomabvset = '{$sigla_setor}'";
        $query .= " AND S.tipset = 'Departamento de Ensino'";

        $result = DBreplicado::fetchAll($query);

        if($result == []) return ["0" => ["nomset" => ""]];

        return $result;
    }

    /**
     * Verifica se uma pessoa é docente, docente aposentado ou docente visitante
     */
    public static function isDocente($codpes){
        $vinculos = Pessoa::vinculosSetores($codpes,8);
        $vinculos = implode(' ',$vinculos);
        return strpos($vinculos, 'Docente') !== false;
    }
    
} 