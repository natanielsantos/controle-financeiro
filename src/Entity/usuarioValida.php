<?php

namespace ControleFinanceiro\Entity;

class usuarioValida {

    public function validar(Usuario $usuario) {
        $mensagem = '';

        if (empty($usuario->getEmail())) {
            $mensagem = 'O email está vazio';
        } else if (empty($usuario->getLogin())) {
            $mensagem = 'O login está vazio';
        } else if (empty($usuario->getSenha())) {
            $mensagem = 'A senha está vazia';
        } else {

            $_SESSION['email'] = $usuario->getEmail();
            $_SESSION['login'] = $usuario->getLogin();

            if (strlen($usuario->getEmail()) < 5 || strlen($usuario->getEmail()) > 100) {
                $mensagem = 'O email deve conter entre 5 e 100 caracteres';
            } else if (strlen($usuario->getLogin()) < 5 ||
                    strlen($usuario->getLogin()) > 20) {
                $mensagem = 'O login deve conter entre 5 e 20 caracteres';
            } else if (strlen($usuario->getSenha()) < 5 ||
                    strlen($usuario->getSenha()) > 50) {
                $mensagem = 'A senha deve conter entre 5 e 50 caracteres';
            }
        }

        return $mensagem;
    }

}
