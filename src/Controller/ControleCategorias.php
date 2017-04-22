<?php

namespace ControleFinanceiro\Controller;

use Symfony\Component\HttpFoundation\Response;

class ControleCategorias {
   
    private $resposta;
    private $twig;
    
    function __construct(Response $resposta, \Twig_Environment $twig) {
       
        $this->resposta = $resposta;
        $this->twig = $twig;
    }
    
    function listar(){
        
        return $this->resposta->setContent($this->twig->render('listaCategorias.tpl', array('titulo'=>'| Categorias')));
    }
}
