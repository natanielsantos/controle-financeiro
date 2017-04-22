<?php

namespace ControleFinanceiro\Controller;

use Symfony\Component\HttpFoundation\Response;

class ControleHome {
   
    private $resposta;
    private $twig;
    
    function __construct(Response $resposta, \Twig_Environment $twig) {
       
        $this->resposta = $resposta;
        $this->twig = $twig;
    }
    
    function ver(){
        
        return $this->resposta->setContent($this->twig->render('home.tpl', array('titulo'=>'| Home')));
    }
}
