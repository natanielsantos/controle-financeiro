<?php

namespace ControleFinanceiro\Models;

use ControleFinanceiro\Util\Conexao;
use PDO;
use ControleFinanceiro\Entity\Categoria;

class ModeloCategorias {

    function __construct() {
        ;
    }
    
    public function getCategoria($id) {
        try {
            $sql = "SELECT * FROM categoria where id_categoria = :id";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':usuario', $id);
            $p_sql->execute();

            return $p_sql->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    

    public function listaCategorias($id_usuario) {
        try {
            $sql = "SELECT * FROM categoria where usuario_id_user = :usuario";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':usuario', $id_usuario);
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
            $psql->bindValue(':usuario',$categoria->getUsuario());
            $psql->execute();
            
            return true;
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
            
    }
    
    public function editar(Categoria $categoria, $id){
        
       // print_r($categoria);
       // print_r($id);
        
        try {
            $sql = "UPDATE categoria SET nome_categoria=:nome, descricao_categoria = :descricao WHERE id_categoria = :id";
            $psql = Conexao::getInstance()->prepare($sql);
            $psql->bindValue(':id',$id);
            $psql->bindValue(':nome', $categoria->getNome());
            $psql->bindValue(':descricao',$categoria->getDescricao());
            
            $psql->execute();
            
            return true;
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
            
    }
    
    public function excluir($id){
        try {
            
            $sql = "DELETE FROM categoria WHERE id_categoria = :id_categoria";
            $psql = Conexao::getInstance()->prepare($sql);
            $psql->bindValue(':id_categoria',$id);
            $psql->execute();
            
            return true;
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        }
        
         public function cadastraPadrao($usuario){
        
        try {
            $sql = "INSERT INTO categoria(nome_categoria, descricao_categoria,usuario_id_user)"
                    . " values (:nome, :descricao, :usuario),"
                    . "(:nome2, :descricao2, :usuario),"
                    . "(:nome3, :descricao3, :usuario),"
                    . "(:nome4, :descricao4, :usuario),"
                    . "(:nome5, :descricao5, :usuario)";
            $psql = Conexao::getInstance()->prepare($sql);
            $psql->bindValue(':usuario',$usuario);
            
            $psql->bindValue(':nome', "Alimentação");
            $psql->bindValue(':descricao',"Lanches, supermercado, feiras, restaurantes...");
            
            $psql->bindValue(':nome2', "Moradia");
            $psql->bindValue(':descricao2',"Luz, água, telefone, aluguel, manutenção...");
            
            $psql->bindValue(':nome3', "Saúde");
            $psql->bindValue(':descricao3',"Remédios, consultas, checkup...");
            
            $psql->bindValue(':nome4', "Lazer");
            $psql->bindValue(':descricao4',"Cinema, viagens, academia...");
            
            $psql->bindValue(':nome5', "Transporte");
            $psql->bindValue(':descricao5',"Combustível, manutenção, viagens, revisões...");
            
            $psql->execute();
            
            return true;
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
            
    }

}
