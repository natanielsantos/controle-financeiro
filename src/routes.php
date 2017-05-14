<?php

// DESCRIÇÃO: Arquivo que irá gerenciar as rotas (requisições depois do / na URL);

namespace ControleFinanceiro\Routes;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

// cria a coleção de rotas
$rotas = new RouteCollection();

// determina os controladores
$C_HOME = 'ControleFinanceiro\Controller\ControleHome';
$C_CATEGORIAS = 'ControleFinanceiro\Controller\ControleCategorias';
$C_USUARIO = 'ControleFinanceiro\Controller\ControleUsuario';

// cria as rotas;
$home = new Route('/', array('_controller' => $C_HOME, '_method' => 'ver'));
$categorias = new Route('/categorias', array('_controller' => $C_CATEGORIAS, '_method' => 'listar'));
$cadastraCategorias = new Route('/cadastraCategoria', array('_controller'=>$C_CATEGORIAS,'_method'=>'cadastrarCategoria'));
$sessao = new Route('/login', array('_controller'=>$C_USUARIO,'_method'=>'exibeLogin'));
$valida_login = new Route('/validaLogin', array('_controller'=>$C_USUARIO,'_method'=>'validaLogin'));

// adiciona as rotas na coleção
$rotas->add('home', $home);
$rotas->add('categorias', $categorias);
$rotas->add('cadastraCategoria',$cadastraCategorias);
$rotas->add('login',$sessao);
$rotas->add('validaLogin', $valida_login);
