<?php

namespace ControleFinanceiro\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use ControleFinanceiro\Models\ModeloReceitas;
use ControleFinanceiro\Models\ModeloDespesas;
use ControleFinanceiro\Models\ModeloCategorias;
use ControleFinanceiro\Models\ModeloFormaPagamento;
use ControleFinanceiro\Entity\Receitas;
use ControleFinanceiro\Util\Session;
use ControleFinanceiro\Util\Funcoes;

class ControleVisao {

    private $resposta;
    private $twig;
    private $request;
    private $session;
    private $modeloReceita;
    private $modeloDespesa;
    private $modeloCategoria;
    private $modeloPagamento;

    function __construct(Response $resposta, Request $request, \Twig_Environment $twig, Session $session) {

        $this->resposta = $resposta;
        $this->twig = $twig;
        $this->request = $request;
        $this->session = $session;

        $this->modeloReceita = new ModeloReceitas();
        $this->modeloDespesa = new ModeloDespesas();
        $this->modeloCategoria = new ModeloCategorias();
        $this->modeloPagamento = new ModeloFormaPagamento();
    }

    function listaItens() {


        $usuario = $this->session->get('nome');

        $today = getdate();
        $dia = $today['mday'];
        $m = $today['mon'];
        $a = $today['year'];

        $jd = gregoriantojd($m, $dia, $a);

        $v = jdmonthname($jd, 0);

        $dadosReceita = $this->modeloReceita->listaItemPorMes($m, $a, $this->session->get('id_user'));
        $dadosDespesa = $this->modeloDespesa->listaItemPorMes($m, $a, $this->session->get('id_user'));
        $dadosCategoria = $this->modeloCategoria->listaCategorias($this->session->get('id_user'));
        $dadosPagamento = $this->modeloPagamento->listaItem($this->session->get('id_user'));

        $somaReceita = Funcoes::calculaTotalReceita($dadosReceita);
        $somaDespesa = Funcoes::calculaTotalDespesa($dadosDespesa);


        if ($usuario != "") {
            return $this->resposta->setContent($this->twig->render('mostraVisao.twig', array('titulo' => 'CF | Visao Geral',
                                'dadosReceita' => $dadosReceita,
                                'dadosDespesa' => $dadosDespesa,
                                'dadosCategoria' => $dadosCategoria,
                                'dadosPagamento' => $dadosPagamento,
                                'somaReceita' => $somaReceita,
                                'somaDespesa' => $somaDespesa,
                                'mes' => $v,
                                'ano' => $a,
                                'usuario' => $usuario)));
        }
    }

    function listaItensPorMesReceita($rota) {


        $campo = explode('&', $rota);
        $mesR = Funcoes::retornaMes($campo[0]);
        $anoR = $campo[1];
        $usuario = $this->session->get('nome');

        $dadosReceita = $this->modeloReceita->listaItemPorMes($campo[0], $anoR, $this->session->get('id_user'));
        $dadosDespesa = $this->modeloDespesa->listaItemPorMes($campo[0], $anoR, $this->session->get('id_user'));
        $dadosCategoria = $this->modeloCategoria->listaCategorias($this->session->get('id_user'));
        $dadosPagamento = $this->modeloPagamento->listaItem($this->session->get('id_user'));

        $somaReceita = Funcoes::calculaTotalReceita($dadosReceita);
        $somaDespesa = Funcoes::calculaTotalReceita($dadosReceita);

        if ($usuario != "") {
            return $this->resposta->setContent($this->twig->render('mostraVisao.twig', array('titulo' => 'CF | Visão Geral',
                                'dadosReceita' => $dadosReceita,
                                'dadosDespesa' => $dadosDespesa,
                                'dadosCategoria' => $dadosCategoria,
                                'dadosPagamento' => $dadosPagamento,
                                'somaReceita' => $somaReceita,
                                'somaDespesa' => $somaDespesa,
                                'usuario' => $usuario,
                                'mes' => $mesR,
                                'ano' => $anoR)));
        }
    }

    public function dados() {
        $dados['tarefas'] = array(
            'Tarefas' => 'Horas por dia',
            'Trabalho' => 6,
            'Escrever livros e tutoriais' => 4,
            'Redes Sociais' => 2,
            'Assistir TV' => 4,
            'Dormir' => 8
        );
        $dados['opcoes'] = array(
            'title' => 'Atividades Diárias'
        );

         echo json_encode($dados);
        
    }

}
