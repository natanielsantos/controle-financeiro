<?php

namespace ControleFinanceiro\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use ControleFinanceiro\Models\ModeloReceitas;
use ControleFinanceiro\Entity\Receitas;
use ControleFinanceiro\Util\Session;

class ControleReceitas {

    private $resposta;
    private $twig;
    private $request;
    private $modelo;
    private $dados;
    private $session;

    function __construct(Response $resposta, Request $request, \Twig_Environment $twig, Session $session) {

        $this->resposta = $resposta;
        $this->twig = $twig;
        $this->request = $request;
        $this->modelo = new ModeloReceitas();
        $this->session = $session;
        $this->dados = $this->modelo->listaItem($session->get('id_user'));
    }

    function listaItens() {
        $usuario = $this->session->get('nome');

        if ($usuario != "") {
            return $this->resposta->setContent($this->twig->render('listaReceitas.twig', array('titulo' => 'CF | Receitas',
                                'dados' => $this->dados,
                                'usuario' => $usuario)));
        }
    }

    function cadastraItem(){

        $fp = new FormaPagamento($this->request->request->get('nome'), $this->request->request->get('descricao'), $this->session->get('id_user'));
        $modeloFormaPagamento = new ModeloReceitas();
        $cadastrou = $modeloFormaPagamento->cadastraItem($fp);

        return $this->resposta->setContent($this->twig->render('listaFormaPagamentos.twig', array('titulo' => 'CF | Receitas',
                            'dados' => $this->dados,
                            'cadastrou' => $cadastrou)));
    }
    
    function editaItem($id){
        
       // $categoria = $modeloCategoria->getCategoria($id);
       
        $novoItem = new Receitas($this->request->request->get('nome'), $this->request->request->get('descricao'), $this->session->get('id_user'));
        
        ModeloFormaPagamento::editaItem($novoItem, $id);

        $redirect = new RedirectResponse('/pagamentos');
        $redirect->send();
        
        return true;
    }
    
    function excluiItem($id){
        
        ModeloFormaPagamento::excluiItem($id);
        
        $redirect = new RedirectResponse('/pagamentos');
        $redirect->send();
        //echo $id;
        return true;
        
    }
    
    function cadastraPadraoItem() {

        $usuario = $this->session->get('id_user');
        $modeloFormaPagamento = new ModeloFormaPagamento();
        $modeloFormaPagamento->cadastraPadraoItem($usuario);

        $redirect = new RedirectResponse('/pagamentos');
        $redirect->send();
        
        return true;
    }

}
