<?php

namespace ControleFinanceiro\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use ControleFinanceiro\Util\Session;
use ControleFinanceiro\Util\Funcoes;
use ControleFinanceiro\Entity\Usuario;
use ControleFinanceiro\Entity\Hash;
use ControleFinanceiro\Models\ModeloUsuario;
use ControleFinanceiro\Models\ModeloHash;

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

    }
    
    function getUsuario($id){
       return $this->modelo->getUsuario($id);
    }

    function exibeLogin() {
        $this->session->destroy();
        return $this->resposta->setContent($this->twig->render('index.html'));
    }

    function exibeCadastroUsuario() {
        $this->session->destroy();
        return $this->resposta->setContent($this->twig->render('cadastro.twig'));
    }

    function cadastraUsuario() {
        
        $cad_nome = $this->request->get('nome');
        $cad_email = $this->request->get('email');
        $cad_senha = $this->request->get('senha');
        
        $dataCadastro = getdate();
        
        $usuario = new Usuario();
        $usuario->setEmail($cad_email);
        $usuario->setSenha($cad_senha);
        $usuario->setLogin($cad_nome);
        $usuario->setStatus(0);
        
        $mensagem = $this->modelo->cadastrar($usuario);
        
        if($mensagem['status']=='sucesso'){
            
            $modeloHash = new ModeloHash();
            $hashGerado = sha1($usuario->getEmail());
            
            $hash = new Hash();
            $hash->setHash($hashGerado);
            $hash->setStatus(0);
            $hash->setIdUsuario($mensagem['idusuario']);
            
            $mensagem = $modeloHash->cadastrar($hash);
            
            if($mensagem['status']=='sucesso'){
                
                $envia = new Funcoes();
                $retorno = $modeloHash->retornaHash($hashGerado);
                $mensagem = $envia->enviaHash($retorno);
                
            }else{
                $mensagem = $mensagem['mensagem'];
            }
            
        } else {
            $mensagem = $mensagem['mensagem'];
        }
        
        return $this->resposta->setContent($this->twig->render('cadastro.twig', array('titulo' => 'CF | Cadastro',
                                'mensagem' => $mensagem )));
    }
    
    function validaHash($hash){
        $modeloHash = new ModeloHash();
        
        $mensagem = $modeloHash->ativar($hash);
        
         if($mensagem['status']=='sucesso'){
             
             $retorno = $modeloHash->retornaHash($hash);
             echo '<br>';
             $idusuario = $retorno['hash']['id_usuario'];
              echo '<br>';
             $usuario = new ModeloUsuario();
             
             
             $msg = $usuario->ativar($idusuario);
             $mensagem = $msg['mensagem'];
             
         } else {
             $mensagem = $mensagem['mensagem'];
         }
        
        return $this->resposta->setContent($this->twig->render('cadastro.twig', array('titulo' => 'CF | Login',
                                'mensagem' => $mensagem )));
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
            
          if($existe['status'] == 1){  
            $this->session->add('nome', $log_nome);
            $this->session->add('senha', $log_senha);
            $this->session->add('id_user', $existe['id_user']);

            $destino = "/home";
            $this->redireciona($destino);
          } else {
            $mensagem = 'Usuário não ativado. Cheque seu email.';
          }
        } else {
            $mensagem = 'Este usuário não existe. Cadastre-se!';
        }
        
         return $this->resposta->setContent($this->twig->render('login.twig', array('titulo' => 'CF | Login',
                                'mensagem' => $mensagem )));
    }

    public function redireciona($destino) {
        $redirect = new RedirectResponse($destino);
        $redirect->send();
    }

    public function destruir() {
        $this->session->destruir();
    }

}
