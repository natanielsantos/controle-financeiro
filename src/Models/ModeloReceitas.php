<?php

namespace ControleFinanceiro\Models;

use ControleFinanceiro\Util\Conexao;
use PDO;
use ControleFinanceiro\Entity\Receitas;

class ModeloReceitas {

    function __construct() {
        ;
    }

    public function getItem($id) {
        try {
            $sql = "SELECT * FROM receita where id_rec = :id";
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
            $sql = "SELECT * FROM receita WHERE usuario_id_user = :usuario ORDER BY data_lanc_rec";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':usuario', $id_usuario);
            $p_sql->execute();

            return $p_sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
        public function listaItemPorMes($mes, $id_usuario) {
        try {
            $sql = "SELECT * FROM receita WHERE usuario_id_user = :usuario AND Month(data_lanc_rec) = :mes ORDER BY data_lanc_rec";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':usuario', $id_usuario);
             $p_sql->bindValue(':mes', $mes);
            $p_sql->execute();

            return $p_sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }


    public function cadastraItem(Receitas $item) {

        try {
            $sql = "INSERT INTO receita (tipo_rec, valor_rec, data_lanc_rec, status_rec, usuario_id_user)
                    values (:tipo, :valor, :data, :status, :usuario)";
            

            $psql = Conexao::getInstance()->prepare($sql);

            $psql->bindValue(':tipo', $item->getTipo());
            $psql->bindValue(':valor', $item->getValor());
            $psql->bindValue(':data', $item->getData());
            $psql->bindValue(':status', $item->getStatus());
            $psql->bindValue(':usuario', $item->getUsuario());
            $psql->execute();
            
            return true;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function editaItem(Receitas $item, $id) {

        try {
            $sql = "UPDATE receita "
                    . "SET tipo_rec=:tipo, valor_rec = :valor, data_lanc_rec=:data, status_rec=:status "
                    . "WHERE id_rec = :id AND usuario_id_user = :usuario";
            $psql = Conexao::getInstance()->prepare($sql);
            $psql->bindValue(':id', $id);
            $psql->bindValue(':tipo', $item->getTipo());
            $psql->bindValue(':valor', $item->getValor());
            $psql->bindValue(':data', $item->getData());
            $psql->bindValue(':status', $item->getStatus());
            $psql->bindValue(':usuario', $item->getUsuario());

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
