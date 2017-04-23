<?php

namespace ControleFinanceiro\Controller;

use Symfony\Component\HttpFoundation\Response;
use ControleFinanceiro\Models\ModeloCategorias;

class ControleCategorias {

    private $resposta;
    private $twig;

    function __construct(Response $resposta, \Twig_Environment $twig) {

        $this->resposta = $resposta;
        $this->twig = $twig;
    }

    function listar() {
        $modelo = new ModeloCategorias();
        $dados = $modelo->listaCategorias();
        return $this->resposta->setContent($this->twig->render('listaCategorias.twig', array('titulo' => '| Categorias', 'dados'=>$dados)));
    }

}
