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
$C_PAGAMENTOS = 'ControleFinanceiro\Controller\ControleFormaPagamento';
$C_USUARIO = 'ControleFinanceiro\Controller\ControleUsuario';
$C_RECEITAS = 'ControleFinanceiro\Controller\ControleReceitas';

// ROTAS GERAIS;
$home = new Route('/home', array('_controller' => $C_HOME, '_method' => 'ver'));
$ajuda = new Route('/ajuda', array('_controller' => $C_HOME, '_method' => 'verAjuda'));
$sessao = new Route('/', array('_controller'=>$C_USUARIO,'_method'=>'exibeLogin'));
$valida_login = new Route('/validaLogin', array('_controller'=>$C_USUARIO,'_method'=>'validaLogin'));

//ROTAS DE CATEGORIAS
$categorias = new Route('/categorias', array('_controller' => $C_CATEGORIAS, '_method' => 'listar'));
$cadastraPadrao = new Route('/cadastraCategoriasPadrao', array('_controller'=>$C_CATEGORIAS,'_method'=>'cadastraPadrao'));
$cadastraCategorias = new Route('/cadastraCategoria', array('_controller'=>$C_CATEGORIAS,'_method'=>'cadastrarCategoria'));
$editaCategorias = new Route('/editaCategoria/id={_param}', array('_controller'=>$C_CATEGORIAS,'_method'=>'editarCategoria'));
$excluiCategorias = new Route('/excluiCategoria/id={_param}', array('_controller'=>$C_CATEGORIAS,'_method'=>'excluirCategoria'));

// ROTAS DE FORMA DE PAGAMENTO
$pagamentos = new Route('/pagamentos', array('_controller' => $C_PAGAMENTOS, '_method' => 'listaItens'));
$cadastraPagamentos = new Route('/cadastraPagamento', array('_controller'=>$C_PAGAMENTOS,'_method'=>'cadastraItem'));
$editaPagamentos = new Route('/editaPagamento/id={_param}', array('_controller'=>$C_PAGAMENTOS,'_method'=>'editaItem'));
$excluiPagamentos = new Route('/excluiPagamento/id={_param}', array('_controller'=>$C_PAGAMENTOS,'_method'=>'excluiItem'));
$cadastraPagamentoPadrao = new Route('/cadastraPagamentosPadrao', array('_controller'=>$C_PAGAMENTOS,'_method'=>'cadastraPadraoItem'));

//ROTAS DE RECEITAS
$receitas = new Route('/receitas', array('_controller' => $C_RECEITAS, '_method' => 'listaItens'));
$cadastraReceitas = new Route('/cadastraReceita', array('_controller'=>$C_RECEITAS,'_method'=>'cadastraItem'));

// ADICIONA AS ROTAS 
$rotas->add('home', $home);
$rotas->add('ajuda', $ajuda);
$rotas->add('login',$sessao);
$rotas->add('validaLogin', $valida_login);

$rotas->add('categorias', $categorias);
$rotas->add('cadastraPadrao',$cadastraPadrao);
$rotas->add('cadastraCategoria',$cadastraCategorias);
$rotas->add('editaCategoria',$editaCategorias);
$rotas->add('excluiCategoria',$excluiCategorias);

$rotas->add('pagamentos', $pagamentos);
$rotas->add('cadastraPagamentos',$cadastraPagamentos);
$rotas->add('editaPagamentos',$editaPagamentos);
$rotas->add('excluiPagamentos',$excluiPagamentos);
$rotas->add('cadastraPadraoItem',$cadastraPagamentoPadrao);

$rotas->add('receitas', $receitas);
$rotas->add('cadastraReceitas',$cadastraReceitas);
