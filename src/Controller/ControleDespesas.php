<?php

namespace ControleFinanceiro\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use ControleFinanceiro\Models\ModeloDespesas;
use ControleFinanceiro\Entity\Despesas;
use ControleFinanceiro\Util\Session;
use ControleFinanceiro\Util\Funcoes;
use ControleFinanceiro\Models\ModeloCategorias;
use ControleFinanceiro\Models\ModeloFormaPagamento;

class ControleDespesas {

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
        $this->modelo = new ModeloDespesas();
        $this->session = $session;
        $this->dados = $this->modelo->listaItem($session->get('id_user'));
    }

    function listaItens() {
        $usuario = $this->session->get('nome');
        $id_usuario = $this->session->get('id_user');
        $categorias = ModeloCategorias::listaCategorias($id_usuario);
        $pagamentos = ModeloFormaPagamento::listaItem($id_usuario);

        $today = getdate();
        $dia = $today['mday'];
        $m = $today['mon'];
        $a = $today['year'];

        $jd = gregoriantojd($m, $dia, $a);

        $v = jdmonthname($jd, 0);

        $dados = $this->modelo->listaItemPorMes($m, $a, $this->session->get('id_user'));
        $qtdItens = Funcoes::contaItens($dados);
        $soma = Funcoes::calculaTotalDespesa($dados);

        if ($usuario != "") {
            return $this->resposta->setContent($this->twig->render('listaDespesas.twig', array('titulo' => 'CF | Despesas',
                                'dados' => $dados,
                                'soma' => $soma,
                                'mes' => $v,
                                'ano' => $a,
                                'qtditens' => $qtdItens,
                                'categorias' => $categorias,
                                'pagamentos' => $pagamentos,
                                'usuario' => $usuario)));
        }
    }

    function listaItensPorMes($rota) {
        $id_usuario = $this->session->get('id_user');
        $categorias = ModeloCategorias::listaCategorias($id_usuario);
        $pagamentos = ModeloFormaPagamento::listaItem($id_usuario);

        //separa o mes e ano
        $campo = explode('&', $rota);
        $mesR = Funcoes::retornaMes($campo[0]);
        $anoR = $campo[1];

        $usuario = $this->session->get('nome');
        $this->dados = $this->modelo->listaItemPorMes($campo[0], $anoR, $this->session->get('id_user'));
        $qtdItens = Funcoes::contaItens($this->dados);


        $soma = Funcoes::calculaTotalDespesa($this->dados);

        if ($usuario != "") {
            return $this->resposta->setContent($this->twig->render('listaDespesas.twig', array('titulo' => 'CF | Despesas',
                                'dados' => $this->dados,
                                'soma' => $soma,
                                'usuario' => $usuario,
                                'mes' => $mesR,
                                'qtditens' => $qtdItens,
                                'categorias' => $categorias,
                                'pagamentos' => $pagamentos,
                                'ano' => $anoR)));
        }
    }

    function cadastraItem() {

        $despesa = new Despesas($this->request->request->get('tipo'), $this->request->request->get('valor'), $this->request->request->get('data'), $this->request->request->get('status'), $this->request->request->get('categoria'), $this->request->request->get('pagamento'), $this->session->get('id_user'));



        $modelo = new ModeloDespesas();
        $modelo->cadastraItem($despesa);
        print_r($despesa);

        $redirect = new RedirectResponse('/despesas');
        $redirect->send();

        return true;
    }

    function editaItem($id) {

        $novoItem = new Despesas($this->request->request->get('tipo'), $this->request->request->get('valor'), $this->request->request->get('data'), $this->request->request->get('status'), $this->request->request->get('categoria'), $this->request->request->get('pagamento'),  $this->session->get('id_user'));
        print_r($novoItem);
        ModeloDespesas::editaItem($novoItem, $id);

      $redirect = new RedirectResponse('/despesas');
      $redirect->send();
        return true;
    }

    function excluiItem($id) {

        ModeloDespesas::excluiItem($id);

        $redirect = new RedirectResponse('/despesas');
        $redirect->send();
        //echo $id;
        return true;
    }

}
