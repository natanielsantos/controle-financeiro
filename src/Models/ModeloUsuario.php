<?php

namespace ControleFinanceiro\Models;

use ControleFinanceiro\Util\Conexao;
use PDO;
use ControleFinanceiro\Entity\Usuario;

class ModeloUsuario {

    function __construct() {
        ;
    }

    public function validaLogin($nome, $senha) {
        try {
            $sql = "SELECT * FROM usuario WHERE usuario = :nome and senha = binary :senha";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':nome', $nome);
            $p_sql->bindValue(':senha', md5(sha1($senha)));
            $p_sql->execute();

            if ($p_sql->rowCount() == 1) {
                $usuario = $p_sql->fetch(PDO::FETCH_ASSOC);
            } else {
                $usuario = false;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        
        return $usuario;
    }

    public function cadastrar(Usuario $usuario) {

        $dados = array();

        $querySelect = "SELECT email, usuario FROM usuario WHERE email = ? OR usuario = ?";
        $stmt = Conexao::getInstance()->prepare($querySelect);
        $stmt->bindValue(1, $usuario->getEmail());
        $stmt->bindValue(2, $usuario->getLogin());

        $resultadoSelect = $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $retorno = $stmt->fetch(PDO::FETCH_ASSOC);
            $dados['status'] = 'erro';

            if ($usuario->getEmail() == $retorno["email"]) {
                $dados['mensagem'] = 'Email já cadastrado';
            } else if ($usuario->getLogin() == $retorno["usuario"]) {
                $dados['mensagem'] = 'Login já cadastrado';
            } else {
                $dados['mensagem'] = 'Não foi possível efetuar o cadastro!';
            }
                
            return $dados;
        } else {

            $query = "INSERT INTO usuario
                        (email, usuario, senha, status, data_cadastro) VALUES (?, ?, ?, ?, now())";
            $stmt = Conexao::getInstance()->prepare($query);
            $stmt->bindValue(1, $usuario->getEmail());
            $stmt->bindValue(2, $usuario->getLogin());
            $stmt->bindValue(3, md5(sha1($usuario->getSenha())));
            $stmt->bindValue(4, $usuario->getStatus());

            $resultado = $stmt->execute();
            $idusuario = Conexao::getInstance()->lastInsertId();

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

        $query = "UPDATE usuario SET status = 1 WHERE id_user = ?";
        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindValue(1, $idusuario);

        $resultado = $stmt->execute();
        
        echo '<br><br>';
        print_r($resultado);

        if ($resultado) {
            $dados['status'] = 'sucesso';
            $dados['mensagem'] = 'Usuário ativado com sucesso';
        } else {
            $dados['status'] = 'erro';
            $dados['mensagem'] = 'Não foi possível ativar o usuário!';
        }
        return $dados;
    }
}
