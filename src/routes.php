<?php


namespace ControleFinanceiro\Routes;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;


$rotas = new RouteCollection();


$C_HOME = 'ControleFinanceiro\Controller\ControleHome';
$C_CATEGORIAS = 'ControleFinanceiro\Controller\ControleCategorias';
$C_PAGAMENTOS = 'ControleFinanceiro\Controller\ControleFormaPagamento';
$C_USUARIO = 'ControleFinanceiro\Controller\ControleUsuario';
$C_RECEITAS = 'ControleFinanceiro\Controller\ControleReceitas';
$C_DESPESAS = 'ControleFinanceiro\Controller\ControleDespesas';
$C_VISAO = 'ControleFinanceiro\Controller\ControleVisao';


$home = new Route('/home', array('_controller' => $C_HOME, '_method' => 'ver'));
$ajuda = new Route('/ajuda', array('_controller' => $C_HOME, '_method' => 'verAjuda'));
$sessao = new Route('/', array('_controller'=>$C_USUARIO,'_method'=>'exibeLogin'));
$valida_login = new Route('/validaLogin', array('_controller'=>$C_USUARIO,'_method'=>'validaLogin'));
$exibeCadastroUsuario = new Route('/cadastro', array('_controller'=>$C_USUARIO,'_method'=>'exibeCadastroUsuario'));
$login= new Route('/login', array('_controller'=>$C_USUARIO,'_method'=>'verLogin')); 
$visaoGeral = new Route('/visaogeral', array('_controller' => $C_VISAO,'_method' => 'listaItens'));
$visaoPorMes = new Route('/visaoMesAno/{_param}', array('_controller' => $C_VISAO, '_method' => 'listaItensPorMes'));
$visaoDados = new Route('/visaogeral/dados', array('_controller' => $C_VISAO, '_method' => 'dados'));
$enviaRelatorioEmail = new Route('/visaogeral/enviarelatorio', array('_controller' => $C_VISAO, '_method' => 'enviaRelatorio'));
$geraPdf = new Route('/visaogeral/gerapdf', array('_controller' => $C_VISAO, '_method' => 'geraPdf'));


$categorias = new Route('/categorias', array('_controller' => $C_CATEGORIAS, '_method' => 'listar'));
$cadastraPadrao = new Route('/cadastraCategoriasPadrao', array('_controller'=>$C_CATEGORIAS,'_method'=>'cadastraPadrao'));
$cadastraCategorias = new Route('/cadastraCategoria', array('_controller'=>$C_CATEGORIAS,'_method'=>'cadastrarCategoria'));
$editaCategorias = new Route('/editaCategoria/id={_param}', array('_controller'=>$C_CATEGORIAS,'_method'=>'editarCategoria'));
$excluiCategorias = new Route('/excluiCategoria/id={_param}', array('_controller'=>$C_CATEGORIAS,'_method'=>'excluirCategoria'));


$pagamentos = new Route('/pagamentos', array('_controller' => $C_PAGAMENTOS, '_method' => 'listaItens'));
$cadastraPagamentos = new Route('/cadastraPagamento', array('_controller'=>$C_PAGAMENTOS,'_method'=>'cadastraItem'));
$editaPagamentos = new Route('/editaPagamento/id={_param}', array('_controller'=>$C_PAGAMENTOS,'_method'=>'editaItem'));
$excluiPagamentos = new Route('/excluiPagamento/id={_param}', array('_controller'=>$C_PAGAMENTOS,'_method'=>'excluiItem'));
$cadastraPagamentoPadrao = new Route('/cadastraPagamentosPadrao', array('_controller'=>$C_PAGAMENTOS,'_method'=>'cadastraPadraoItem'));


$receitas = new Route('/receitas', array('_controller' => $C_RECEITAS, '_method' => 'listaItens'));
$receitasPorMes = new Route('/receitasMesAno/{_param}', array('_controller' => $C_RECEITAS, '_method' => 'listaItensPorMes'));
$cadastraReceitas = new Route('/cadastraReceita', array('_controller'=>$C_RECEITAS,'_method'=>'cadastraItem'));
$editaReceitas = new Route('/editaReceita/id={_param}', array('_controller'=>$C_RECEITAS,'_method'=>'editaItem'));
$excluiReceitas = new Route('/excluiReceita/{_param}', array('_controller'=>$C_RECEITAS,'_method'=>'excluiItem'));


$despesas = new Route('/despesas ', array('_controller' => $C_DESPESAS , '_method' => 'listaItens'));
$despesasPorMes = new Route('/despesasMesAno/{_param}', array('_controller' => $C_DESPESAS , '_method' => 'listaItensPorMes'));
$cadastraDespesas  = new Route('/cadastraDespesa', array('_controller'=>$C_DESPESAS ,'_method'=>'cadastraItem'));
$editaDespesas = new Route('/editaDespesa/{_param}', array('_controller'=>$C_DESPESAS ,'_method'=>'editaItem'));
$excluiDespesas = new Route('/excluiDespesa/{_param}', array('_controller'=>$C_DESPESAS ,'_method'=>'excluiItem'));


$cadastraUsuario = new Route('/cadastraUsuario', array('_controller'=>$C_USUARIO,'_method'=>'cadastraUsuario'));
$validaCodigo = new Route('/codigo={_param}', array('_controller'=>$C_USUARIO,'_method'=>'validaHash'));


$rotas->add('home', $home);
$rotas->add('ajuda', $ajuda);
$rotas->add('sessao',$sessao);
$rotas->add('validaLogin', $valida_login);
$rotas->add('visaoGeral', $visaoGeral);
$rotas->add('visaoDados', $visaoDados);
$rotas->add('enviaRelatorio', $enviaRelatorioEmail);
$rotas->add('geraPdf', $geraPdf);
$rotas->add('cadastro', $exibeCadastroUsuario);
$rotas->add('login', $login);

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
$rotas->add('receitasPorMes', $receitasPorMes);
$rotas->add('cadastraReceitas',$cadastraReceitas);
$rotas->add('editaReceitas',$editaReceitas);
$rotas->add('excluiReceitas',$excluiReceitas);

$rotas->add('despesas', $despesas);
$rotas->add('despesasPorMes', $despesasPorMes);
$rotas->add('cadastraDepesa',$cadastraDespesas);
$rotas->add('editaDespesa',$editaDespesas);
$rotas->add('excluiDespesa',$excluiDespesas);

$rotas->add('usuario', $cadastraUsuario);
$rotas->add('validaHash', $validaCodigo);