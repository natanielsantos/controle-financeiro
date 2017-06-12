<?php

namespace ControleFinanceiro\Models;

use ControleFinanceiro\Util\Conexao;
use PDO;
use ControleFinanceiro\Entity\FormaPagamento;

class ModeloFormaPagamento {

    function __construct() {
        ;
    }

    public function getItem($id) {
        try {
            $sql = "SELECT * FROM forma_pagamento where id_form_pag = :id";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':usuario', $id);
            $p_sql->execute();

            return $p_sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function listaItem($id_usuario) {
        try {
            $sql = "SELECT * FROM forma_pagamento where usuario_id_user = :usuario";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':usuario', $id_usuario);
            $p_sql->execute();

            return $p_sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function cadastraItem(FormaPagamento $item) {

        try {
            $sql = "INSERT INTO forma_pagamento(nome_form_pag, descricao_form_pag,usuario_id_user) values (:nome, :descricao, :usuario)";
            $psql = Conexao::getInstance()->prepare($sql);
            $psql->bindValue(':nome', $item->getNome());
            $psql->bindValue(':descricao', $item->getDescricao());
            $psql->bindValue(':usuario', $item->getUsuario());
            $psql->execute();


            return true;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function editaItem(FormaPagamento $item, $id) {

        // print_r($categoria);
        // print_r($id);

        try {
            $sql = "UPDATE forma_pagamento SET nome_form_pag=:nome, descricao_form_pag = :descricao WHERE id_form_pag = :id";
            $psql = Conexao::getInstance()->prepare($sql);
            $psql->bindValue(':id', $id);
            $psql->bindValue(':nome', $item->getNome());
            $psql->bindValue(':descricao', $item->getDescricao());

            $psql->execute();

            return true;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function excluiItem($id) {
        try {

            $sql = "DELETE FROM forma_pagamento WHERE id_form_pag = :id_form_pag";
            $psql = Conexao::getInstance()->prepare($sql);
            $psql->bindValue(':id_form_pag', $id);
            $psql->execute();

            return true;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function cadastraPadraoItem($usuario) {

        try {
            $sql = "INSERT INTO forma_pagamento(nome_form_pag, descricao_form_pag,usuario_id_user)"
                    . " values (:nome, :descricao, :usuario),"
                    . "(:nome2, :descricao2, :usuario),"
                    . "(:nome3, :descricao3, :usuario),"
                    . "(:nome4, :descricao4, :usuario),"
                    . "(:nome5, :descricao5, :usuario)";
            $psql = Conexao::getInstance()->prepare($sql);
            $psql->bindValue(':usuario', $usuario);
            $psql->bindValue(':nome', "Dinheiro");
            $psql->bindValue(':descricao', "Moedas, notas...");
            $psql->bindValue(':nome2', "Cheque");
            $psql->bindValue(':descricao2', "...");
            $psql->bindValue(':nome3', "Cartão de Crédito");
            $psql->bindValue(':descricao3', "...");
            $psql->bindValue(':nome4', "Débito em Conta");
            $psql->bindValue(':descricao4', "...");
            $psql->bindValue(':nome5', "Boleto");
            $psql->bindValue(':descricao5', "...");
            $psql->execute();

            return true;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
