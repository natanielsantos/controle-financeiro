<?php

namespace ControleFinanceiro\Util;

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

    function contaItens($vetor) {

        $qtdItens = count($vetor);

        return $qtdItens;
    }

}

//