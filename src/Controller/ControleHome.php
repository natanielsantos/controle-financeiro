<?php

namespace ControleFinanceiro\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use ControleFinanceiro\Util\Session;

class ControleHome {

    private $resposta;
    private $twig;
    private $request;
    private $session;

    function __construct(Response $resposta, Request $request, \Twig_Environment $twig, Session $session) {

        $this->resposta = $resposta;
        $this->twig = $twig;
        $this->request = $request;
        $this->session = $session;
    }

    function ver() {

        $usuario = $this->session->get('nome');

        if ($usuario != "") {
            return $this->resposta->setContent($this->twig->render('home.twig', array('titulo' => 'CF | Home', 'usuario' => $usuario)));
        } else {
            $redirect = new RedirectResponse('/');
            $redirect->send();
        }
    }

    function verAjuda() {

        $usuario = $this->session->get('nome');

        if ($usuario != "") {
            return $this->resposta->setContent($this->twig->render('ajuda.twig', array('titulo' => 'CF | Ajuda', 'usuario' => $usuario)));
        } else {
            $redirect = new RedirectResponse('/');
            $redirect->send();
        }
    }

}
