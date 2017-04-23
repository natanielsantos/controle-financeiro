<?php

// DESCRIÇÃO: Arquivo que irá gerenciar as rotas (requisições depois do / na URL);

namespace ControleFinanceiro\Routes;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

// criar o objeto de rotas
$rotas = new RouteCollection();

// controladores
$C_HOME = 'ControleFinanceiro\Controller\ControleHome';
$C_CATEGORIAS = 'ControleFinanceiro\Controller\ControleCategorias';

// criar as rotas;
$home = new Route('/', array('_controller' => $C_HOME, '_method' => 'ver'));
$categorias = new Route('/categorias', array('_controller' => $C_CATEGORIAS, '_method' => 'listar'));

// adicionar no objeto de rotas
$rotas->add('home', $home);
$rotas->add('categorias', $categorias);
