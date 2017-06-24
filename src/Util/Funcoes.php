<?php

namespace ControleFinanceiro\Util;

class Funcoes {

    // funcão para gerar os meses na barra de filtro
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

    // funcao para calcular o total da receita para aparecer na visão geral
    function calculaTotalReceita($vetor) {

        $total = 0;

        foreach ($vetor as $v) {
            $total = $v['valor_rec'] + $total;
        }

        return $total;
    }

    // funcao para calcular o total da despesa para aparecer na visão geral
    function calculaTotalDespesa($vetor) {

        $total = 0;

        foreach ($vetor as $v) {
            $total = $v['valor_desp'] + $total;
        }

        return $total;
    }

    // funcao para contar quantos itens possui um vetor
    function contaItens($vetor) {

        $qtdItens = count($vetor);

        return $qtdItens;
    }

}

//