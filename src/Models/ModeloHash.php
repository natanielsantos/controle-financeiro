<?php

namespace ControleFinanceiro\Models;

use ControleFinanceiro\Util\Conexao;
use PDO;
use ControleFinanceiro\Entity\Hash;

class ModeloHash {

    function __construct() {
        ;
    }

    public function cadastrar(Hash $hash) {

        $dados = array();

        $query = "INSERT INTO hash (hash, status, id_usuario, data_cadastro) VALUES (?, ?, ?, now())";
        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindValue(1, $hash->getHash());
        $stmt->bindValue(2, $hash->getStatus());
        $stmt->bindValue(3, $hash->getIdUsuario());

        $resultado = $stmt->execute();

        if ($resultado) {
            $dados['status'] = 'sucesso';
            $dados['mensagem'] = 'Chave de autenticação gerada!';
        } else {
            $dados['status'] = 'erro';
            $dados['mensagem'] = 'Não foi possível realizar a verificação da conta';
        }
        return $dados;
    }

    public function retornaHash($hash) {

        $dados = array();

        $query = "SELECT id, hash, id_usuario, data_cadastro FROM hash
          WHERE hash = ? ORDER BY id DESC LIMIT 1";
        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindValue(1, $hash);

        $resultado = $stmt->execute();

        if ($resultado) {

            if ($stmt->rowCount() > 0) {
                $dados['hash'] = $stmt->fetch(PDO::FETCH_ASSOC);
                $dados['status'] = 'sucesso';
                $dados['mensagem'] = 'Chave enviada com sucesso!';
            } else {
                $dados['status'] = 'erro';
                $dados['mensagem'] = 'Hash inválida!';
            }
        } else {
            $dados['status'] = 'erro';
            $dados['mensagem'] = 'Não foi possível capturar a chave de ativação!';
        }

        return $dados;
    }

    public function ativar($hash) {

        $dados = array();

        $query = "UPDATE hash SET status = 1 WHERE hash = ? LIMIT 1";
        $stmt = Conexao::getInstance()->prepare($query);
        $stmt->bindValue(1, $hash);

        $resultado = $stmt->execute();

        if ($resultado) {
            $dados['status'] = 'sucesso';
            $dados['mensagem'] = 'Código ativado com sucesso';
        } else {
            $dados['status'] = 'erro';
            $dados['mensagem'] = 'Código não foi ativado';
        }

        return $dados;
    }

}
