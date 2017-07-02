<?php

namespace ControleFinanceiro\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use ControleFinanceiro\Models\ModeloReceitas;
use ControleFinanceiro\Entity\Receitas;
use ControleFinanceiro\Util\Session;
use ControleFinanceiro\Util\Funcoes;

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


        $today = getdate();
        $dia = $today['mday'];
        $m = $today['mon'];
        $a = $today['year'];

        $jd = gregoriantojd($m, $dia, $a);

        $v = jdmonthname($jd, 0);

        $dados = $this->modelo->listaItemPorMes($m, $a, $this->session->get('id_user'));

        $soma = Funcoes::calculaTotalReceita($dados);

        if ($usuario != "") {
            return $this->resposta->setContent($this->twig->render('listaReceitas.twig', array('titulo' => 'CF | Receitas',
                                'dados' => $dados,
                                'soma' => $soma,
                                'mes' => $v,
                                'ano' => $a,
                                'usuario' => $usuario)));
        }
    }

    function listaItensPorMes($rota) {

        //separa o mes e ano
        $campo = explode('&', $rota);
        $mesR = Funcoes::retornaMes($campo[0]);
        $anoR = $campo[1];

        $usuario = $this->session->get('nome');
        $this->dados = $this->modelo->listaItemPorMes($campo[0], $anoR, $this->session->get('id_user'));

        $soma = Funcoes::calculaTotalReceita($this->dados);

        if ($usuario != "") {
            return $this->resposta->setContent($this->twig->render('listaReceitas.twig', array('titulo' => 'CF | Receitas',
                                'dados' => $this->dados,
                                'soma' => $soma,
                                'usuario' => $usuario,
                                'mes' => $mesR,
                                'ano' => $anoR)));
        }
    }

    function cadastraItem() {

        $receita = new Receitas($this->request->request->get('tipo'), $this->request->request->get('valor'), $this->request->request->get('data'), $this->request->request->get('status'), $this->session->get('id_user'));


        $modelo = new ModeloReceitas();
        $cadastrou = $modelo->cadastraItem($receita);

        $redirect = new RedirectResponse('/receitas');
        $redirect->send();
        
        return true;
    }

    function editaItem($id) {

        $novoItem = new Receitas($this->request->request->get('tipo'), $this->request->request->get('valor'), $this->request->request->get('data'), $this->request->request->get('status'), $this->session->get('id_user'));

        $this->modelo->editaItem($novoItem, $id);

        $redirect = new RedirectResponse('/receitas');
        $redirect->send();

        return true;
    }

    function excluiItem($id) {

        $this->modelo->excluiItem($id);

        $redirect = new RedirectResponse('/receitas');
        $redirect->send();
        //echo $id;
        return true;
    }

}
