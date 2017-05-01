<?php

namespace ControleFinanceiro\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ControleHome {

    private $resposta;
    private $twig;
    private $request;

    function __construct(Response $resposta, Request $request, \Twig_Environment $twig) {

        $this->resposta = $resposta;
        $this->twig = $twig;
        $this->request = $request;
        
    }

    function ver() {

        return $this->resposta->setContent($this->twig->render('home.twig', array('titulo' => '| Home')));
    }

}
