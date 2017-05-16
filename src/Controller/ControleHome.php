<?php

namespace ControleFinanceiro\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ControleFinanceiro\Util\Session;

class ControleHome {

    private $resposta;
    private $twig;
    private $request;

    function __construct(Response $resposta, Request $request, \Twig_Environment $twig, Session $session) {

        $this->resposta = $resposta;
        $this->twig = $twig;
        $this->request = $request;
        
    }

    function ver() {
        if( isset($this->session->get('usuario')));//verifica se existe o usuário
            return $this->resposta->setContent($this->twig->render('home.twig', array('titulo' => 'CF | Home')));
             
    }

}
