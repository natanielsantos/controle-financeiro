<?php

namespace ControleFinanceiro\Models;

use ControleFinanceiro\Util\Conexao;
use PDO;
use ControleFinanceiro\Entity\Despesas;

class ModeloDespesas {

    private $qtdColunas;

    function __construct() {
        ;
    }

    public function getItem($id) {
        try {
            $sql = "SELECT * FROM despesa where id_des = :id";
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
            $sql = "SELECT * FROM despesas WHERE usuario_id_user = :usuario ORDER BY data_venc_desp";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':usuario', $id_usuario);
            $p_sql->execute();

            $this->qtdColunas = $p_sql->columnCount();

            return $p_sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function listaItemPorMes($mes, $ano, $id_usuario) {
        try {
            $sql = "SELECT * FROM despesa "
                    . "WHERE usuario_id_user = :usuario "
                    . "AND Month(data_venc_desp) = :mes "
                    . "AND Year(data_venc_desp) = :ano "
                    . "ORDER BY data_venc_desp";

            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':usuario', $id_usuario);
            $p_sql->bindValue(':mes', $mes);
            $p_sql->bindValue(':ano', $ano);
            $p_sql->execute();

            return $p_sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function cadastraItem(Despesas $item) {

        try {
            $sql = "INSERT INTO despesa (descricao_desp, valor_desp, data_venc_desp, status_desp, categoria_id_categoria, forma_pagamento_id_form_pag, usuario_id_user)
                       VALUES (:tipo, :valor, :data, :status,:categoria,:pagamento, :usuario)";


            $psql = Conexao::getInstance()->prepare($sql);

            $psql->bindValue(':tipo', $item->getTipo());
            $psql->bindValue(':valor', $item->getValor());
            $psql->bindValue(':data', $item->getData());
            $psql->bindValue(':categoria', $item->getCategoria());
            $psql->bindValue(':pagamento', $item->getPagamento());
            $psql->bindValue(':status', $item->getStatus());
            $psql->bindValue(':usuario', $item->getUsuario());
            $psql->execute();

            return true;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function editaItem(Despesas $item, $id) {

        try {
            $sql = "UPDATE despesa "
                    . "SET descricao_desp = :tipo, valor_desp = :valor, data_venc_desp =:data, status_desp =:status, categoria_id_categoria=:categoria, forma_pagamento_id_form_pag = :pagamento "
                    . "WHERE id_desp = :id "
                    . "AND usuario_id_user = :usuario";

            $psql = Conexao::getInstance()->prepare($sql);
            $psql->bindValue(':id', $id);
            $psql->bindValue(':tipo', $item->getTipo());
            $psql->bindValue(':valor', $item->getValor());
            $psql->bindValue(':data', $item->getData());
            $psql->bindValue(':status', $item->getStatus());
            $psql->bindValue(':categoria', $item->getCategoria());
            $psql->bindValue(':pagamento', $item->getPagamento());
            $psql->bindValue(':usuario', $item->getUsuario());
            $psql->execute();

            return true;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function excluiItem($id) {
        try {

            $sql = "DELETE FROM despesa WHERE id_desp = :id_desp";
            $psql = Conexao::getInstance()->prepare($sql);
            $psql->bindValue(':id_desp', $id);
            $psql->execute();

            return true;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

   static function  qtdColunas() {

        $qtdColunas = $this->qtdColunas;
        return $qtdColunas;
    }

}
