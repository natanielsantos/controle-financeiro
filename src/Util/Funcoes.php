<?php

namespace ControleFinanceiro\Util;

use ControleFinanceiro\Models\ModeloDespesas;
use ControleFinanceiro\Util\Conexao;
use PDO;
use ControleFinanceiro\Entity\Despesas;

class Funcoes {

    function retornaMes($num) {
        switch ($num) {
            case "1": $mes = "jan";
                break;
            case "2": $mes = "fev";
                break;
            case "3": $mes = "mar";
                break;
            case "4": $mes = "abr";
                break;
            case "5": $mes = "Mai";
                break;
            case "6": $mes = "jun";
                break;
            case "7": $mes = "jul";
                break;
            case "8": $mes = "ago";
                break;
            case "9": $mes = "set";
                break;
            case "10": $mes = "out";
                break;
            case "11": $mes = "nov";
                break;
            case "12": $mes = "dez";
                break;
        }

        return $mes;
    }

    public function contaColunas($vetor) {
        try {
            $sql = "show fields from :vetor";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':vetor', $vetor);
            $p_sql->execute();

            return $p_sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    function calculaTotalReceita($vetor) {

        $total = 0;

        foreach ($vetor as $v) {
            $total = $v['valor_rec'] + $total;
        }

        return $total;
    }

    function calculaTotalDespesa($vetor) {

        $total = 0;

        foreach ($vetor as $v) {
            $total = $v['valor_desp'] + $total;
        }

        return $total;
    }

}

//