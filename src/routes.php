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

// cria as rotas;
$home = new Route('/', array('_controller' => $C_HOME, '_method' => 'ver'));
$categorias = new Route('/categorias', array('_controller' => $C_CATEGORIAS, '_method' => 'listar'));
$cadastraCategorias = new Route('/cadastraCategoria', array('_controller'=>$C_CATEGORIAS,'_method'=>'cadastrarCategoria'));

// adiciona as rotas na coleção
$rotas->add('home', $home);
$rotas->add('categorias', $categorias);
$rotas->add('cadastraCategoria',$cadastraCategorias);
