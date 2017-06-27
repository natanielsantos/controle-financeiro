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

        $query = "INSERT INTO {$this->tabela} (hash, status, id_usuario, data_cadastro) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $hash->getHash());
        $stmt->bindValue(2, $hash->getStatus());
        $stmt->bindValue(3, $hash->getIdUsuario());
        $stmt->bindValue(4, $hash->getDataCadastro());

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

        $query = "SELECT id, hash, id_usuario, data_cadastro FROM {$this->tabela} 
          WHERE hash = ? ORDER BY id DESC LIMIT 1";
        $stmt = $this->conexao->prepare($query);
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

    public function ativar($id) {

        $dados = array();

        $query = "UPDATE {$this->tabela} SET status = 1 WHERE id = ? LIMIT 1";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $id);

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
