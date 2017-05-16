<?php

namespace ControleFinanceiro\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ControleFinanceiro\Models\ModeloCategorias;
use ControleFinanceiro\Entity\Categoria;
use ControleFinanceiro\Util\Session;


class ControleCategorias {

    private $resposta;
    private $twig;
    private $request;
    private $modelo;
    private $dados;

    function __construct(Response $resposta, Request $request ,\Twig_Environment $twig, Session $session) {

        $this->resposta = $resposta;
        $this->twig = $twig;
        $this->request = $request;
        $this->modelo = new ModeloCategorias();
        $this->dados = $this->modelo->listaCategorias();
    }
    
    function listar() {
        return $this->resposta->setContent($this->twig->render('listaCategorias.twig', array('titulo' => 'CF | Categorias', 'dados'=>$this->dados)));
    }
    
    function cadastrarCategoria(){
        
        $categoria = new Categoria(
                           $this->request->request->get('nome'),
                           $this->request->request->get('descricao'),
                           $this->request->request->get('usuario'));
        $modeloCategoria = new ModeloCategorias();
        $cadastrou = $modeloCategoria->cadastrar($categoria);
        
        return $this->resposta->setContent($this->twig->render('listaCategorias.twig', array('titulo' => 'CF | Categorias', 'dados'=>$this->dados,'cadastrou'=>$cadastrou)));
    }

}
