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
        // $dados = $this->modelo->listaItemPorMes($mes, $this->session->get('id_user'));
        $soma = ControleReceitas::calculaTotal();

        if ($usuario != "") {
            return $this->resposta->setContent($this->twig->render('listaReceitas.twig', array('titulo' => 'CF | Receitas',
                                'dados' => $this->dados,
                                'soma' => $soma,
                                'usuario' => $usuario)));
        }
    }

    function listaItensPorMes($mes) {
        $usuario = $this->session->get('nome');
        $this->dados = $this->modelo->listaItemPorMes($mes, $this->session->get('id_user'));
        $soma = ControleReceitas::calculaTotal();

        if ($usuario != "") {
            return $this->resposta->setContent($this->twig->render('listaReceitas.twig', array('titulo' => 'CF | Receitas',
                                'dados' => $this->dados,
                                'soma' => $soma,
                                'usuario' => $usuario)));
        }
    }

    function cadastraItem() {

        $receita = new Receitas($this->request->request->get('tipo'), $this->request->request->get('valor'), $this->request->request->get('data'), $this->request->request->get('status'), $this->session->get('id_user'));


        $modelo = new ModeloReceitas();
        $cadastrou = $modelo->cadastraItem($receita);

        return $this->resposta->setContent($this->twig->render('listaReceitas.twig', array('titulo' => 'CF | Receitas',
                            'dados' => $this->dados,
                            'cadastrou' => $cadastrou)));
    }

    function editaItem($id) {

        // $categoria = $modeloCategoria->getCategoria($id);

        $novoItem = new Receitas($this->request->request->get('tipo'), $this->request->request->get('valor'), $this->request->request->get('data'), $this->request->request->get('status'), $this->session->get('id_user'));

        ModeloReceitas::editaItem($novoItem, $id);

        $redirect = new RedirectResponse('/receitas');
        $redirect->send();

        return true;
    }

    function excluiItem($id) {

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

    function calculaTotal() {

        $total = 0;

        foreach ($this->dados as $v) {
            $total = $v['valor_rec'] + $total;
        }

        return $total;
    }

}
