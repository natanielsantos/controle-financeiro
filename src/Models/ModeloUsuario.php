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
            $p_sql->bindValue(':nome', $nome);
            $p_sql->bindValue(':senha', $senha);
            $p_sql->execute();

            if ($p_sql->rowCount() == 1) {
                return $p_sql->fetch(PDO::FETCH_OBJ);
            } else {
                return false;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function cadastrar(Usuario $usuario) {

        $dados = array();

        $querySelect = "SELECT email, login FROM {$this->tabela} WHERE email = ? OR login = ?";
        $stmt = $this->conexao->prepare($querySelect);
        $stmt->bindValue(1, $usuario->getEmail());
        $stmt->bindValue(2, $usuario->getLogin());

        $resultadoSelect = $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $retorno = $stmt->fetch(PDO::FETCH_ASSOC);
            $dados['status'] = 'erro';

            if ($usuario->getEmail() == $retorno["email"]) {
                $dados['mensagem'] = 'Email já cadastrado';
            } else if ($usuario->getLogin() == $retorno["login"]) {
                $dados['mensagem'] = 'Login já cadastrado';
            } else {
                $dados['mensagem'] = 'Não foi possível efetuar o cadastro!';
            }

            return $dados;
        } else {

            $query = "INSERT INTO {$this->tabela} 
                        (email, login, senha, status, data_cadastro) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1, $usuario->getEmail());
            $stmt->bindValue(2, $usuario->getLogin());
            $stmt->bindValue(3, $usuario->getSenha());
            $stmt->bindValue(4, $usuario->getStatus());
            $stmt->bindValue(5, $usuario->getDataCadastro());

            $resultado = $stmt->execute();
            $idusuario = $this->conexao->lastInsertId();

            if ($resultado) {
                $dados['status'] = 'sucesso';
                $dados['idusuario'] = $idusuario;
                $dados['mensagem'] = 'Cadastrado com sucesso';
            } else {
                $dados['status'] = 'erro';
                $dados['mensagem'] = 'Não foi possível efetuar o cadastro!';
            }
            return $dados;
        }
    }

    public function ativar($idusuario) {

        $dados = array();

        $query = "UPDATE {$this->tabela} SET status = 1 WHERE id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $idusuario);

        $resultado = $stmt->execute();

        if ($resultado) {
            $dados['status'] = 'sucesso';
            $dados['mensagem'] = 'Usuário ativado com sucesso';
        } else {
            $dados['status'] = 'erro';
            $dados['mensagem'] = 'Não foi possível ativar o usuário!';
        }
        return $dados;
    }

    /* public function cadastrar(Categoria $categoria) {

      try {
      $sql = "INSERT INTO categoria(nome_categoria, descricao_categoria,usuario_id_user) values (:nome, :descricao, :usuario)";
      $psql = Conexao::getInstance()->prepare($sql);
      $psql->bindValue(':nome', $categoria->getNome());
      $psql->bindValue(':descricao', $categoria->getDescricao());
      $psql->bindValue(':usuario', 1);
      $psql->execute();

      return true;
      } catch (Exception $exc) {
      echo $exc->getTraceAsString();
      }
      } */
}
