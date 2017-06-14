<?php

namespace ControleFinanceiro\Models;

use ControleFinanceiro\Util\Conexao;
use PDO;
use ControleFinanceiro\Entity\Categoria;

class ModeloUsuario {

    function __construct() {
        ;
    }

    public function validaLogin($nome, $senha) {
        try {
            $sql = "SELECT * FROM usuario WHERE usuario = :nome and senha = binary :senha";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':nome',$nome);
            $p_sql->bindValue(':senha',$senha);
            $p_sql->execute();
            
            if ($p_sql->rowCount()==1){
                return $p_sql->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }
            
            
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
