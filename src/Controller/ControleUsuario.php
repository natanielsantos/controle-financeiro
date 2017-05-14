<?php

namespace ControleFinanceiro\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ControleFinanceiro\Util\Session;
use ControleFinanceiro\Entity\Usuario;
use ControleFinanceiro\Models\ModeloUsuario;

class ControleUsuario {

    private $resposta;
    private $twig;
    private $request;
    private $modelo;
    private $dados;

    function __construct(Response $resposta, Request $request ,\Twig_Environment $twig) {

        $this->resposta = $resposta;
        $this->twig = $twig;
        $this->request = $request;
        $this->modelo = new ModeloUsuario();
       // $this->dados = $this->modelo->validaLogin($nome, $senha);
    }
    
    function exibeLogin(){
        
        return $this->resposta->setContent($this->twig->render('login.html'));
    }
    
    function validaLogin(){
        
        $log_nome = $this->request->get('nome');
        $log_senha = $this->request->get('senha');
        
        $logado = $this->modelo->validaLogin($log_nome, $log_senha);
        
        if($logado){
            $sessao = new Session();
                $sessao->add('nome', $log_nome);
                $sessao->add('senha', $log_senha);
                
            return $this->resposta->setContent($this->twig->render('home.twig', array('titulo' => 'CF | Home')));
            
        }else{
            ControleUsuario::exibeLogin();
        }
        
    }

}
