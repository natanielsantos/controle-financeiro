<?php

namespace ControleFinanceiro\Models;

use ControleFinanceiro\Util\Conexao;
use PDO;

class ModeloCategorias {

    function __construct() {
        ;
    }

    public function cadastrar() {
        ;
    }

    public function listaCategorias() {
        try {
            $sql = "SELECT * FROM categoria";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();

            return $p_sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
