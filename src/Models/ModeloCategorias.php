<?php

namespace ControleFinanceiro\Models;

use ControleFinanceiro\Util\Conexao;
use PDO;
use ControleFinanceiro\Entity\Categoria;

class ModeloCategorias {

    function __construct() {
        ;
    }

    public function listaCategorias() {
        try {
            $sql = "SELECT * FROM categoria where usuario_id_user = 2";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();

            return $p_sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function cadastrar(Categoria $categoria){
        
        try {
            $sql = "INSERT INTO categoria(nome_categoria, descricao_categoria,usuario_id_user) values (:nome, :descricao, :usuario)";
            $psql = Conexao::getInstance()->prepare($sql);
            $psql->bindValue(':nome', $categoria->getNome());
            $psql->bindValue(':descricao',$categoria->getDescricao());
            $psql->bindValue(':usuario',1);
            $psql->execute();
            
            return true;
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
            
    }

}
