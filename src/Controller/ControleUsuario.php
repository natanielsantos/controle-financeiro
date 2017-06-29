<?php

namespace ControleFinanceiro\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use ControleFinanceiro\Util\Session;
use ControleFinanceiro\Entity\Usuario;
use ControleFinanceiro\Models\ModeloUsuario;

class ControleUsuario {

    private $resposta;
    private $twig;
    private $request;
    private $modelo;
    private $dados;
    private $session;
    private $usuario;

    function __construct(Response $resposta, Request $request, \Twig_Environment $twig, Session $session) {

        $this->resposta = $resposta;
        $this->twig = $twig;
        $this->request = $request;
        $this->modelo = new ModeloUsuario();
        $this->session = $session;

        // $this->dados = $this->modelo->validaLogin($nome, $senha);
    }

    function exibeLogin() {
        $this->session->destroy();
        return $this->resposta->setContent($this->twig->render('index.html'));
    }

    function cadastraUsuario() {
        $this->session->destroy();
        return $this->resposta->setContent($this->twig->render('cadastro.twig'));
    }

    function verLogin() {
        $this->session->destroy();
        return $this->resposta->setContent($this->twig->render('login.twig'));
    }

    function validaLogin() {


        $log_nome = $this->request->get('nome');
        $log_senha = $this->request->get('senha');

        $existe = $this->modelo->validaLogin($log_nome, $log_senha);

        if ($existe) {

            $this->session->add('nome', $log_nome);
            $this->session->add('senha', $log_senha);
            $this->session->add('id_user', $existe->id_user);

            $destino = "/home";
            $this->redireciona($destino);
        } else {
            ControleUsuario::exibeLogin();
        }
    }

    public function redireciona($destino) {
        $redirect = new RedirectResponse($destino);
        $redirect->send();
    }

    public function destruir() {
        $this->session->destruir();
    }

}
