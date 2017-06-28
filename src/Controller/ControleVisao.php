<?php

namespace ControleFinanceiro\Controller;

use Mailgun\Mailgun;
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
use PHPMailer;

class ControleVisao {

    private $resposta;
    private $twig;
    private $request;
    private $session;
    private $modeloReceita;
    private $modeloDespesa;
    private $modeloCategoria;
    private $modeloPagamento;
    private $somaReceita;
    private $somaDespesa;

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

        $this->session->add('somar', $somaReceita);
        $this->session->add('somad', $somaDespesa);

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
        $email = $this->session->get('email');

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
                                'usu rio' => $usuario,
                                'mes' => $mesR,
                                'ano' => $anoR)));
        }
    }

    public function dados() {

        $receita = $this->session->get('somar');
        $despesa = $this->session->get('somad');

        $dados['tarefas'] = array(
            'Tarefas' => 'Horas por dia',
            'Receita' => $receita,
            'Despesa' => $despesa
        );
        $dados['opcoes'] = array(
            'title' => 'Receitas x Despsas'
        );

        echo json_encode($dados);
    }

    function enviaRelatorio() {

        $mail = new PHPMailer();

        //$mail->SMTPDebug = 2;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'controlei.trabalho@gmail.com';                 // SMTP username
        $mail->Password = '943491el!!';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('controlei.trabalho@gmail.com', 'Controlei.pe.hu');
        $mail->addAddress('natanielsa@gmail.com', 'Nataniel');    // Add a recipient

        /* $mail->addAddress('pauliran@gmail.com');               // Name is optional
          $mail->addReplyTo('arquivosnatax@gmail.com', 'Informação');
          $mail->addCC('cc@example.com');
          $mail->addBCC('bcc@example.com'); */

        $mail->addAttachment('/var/tmp/teste.pdf', "Relatorio Financeiro");         // Add attachments
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Meu Relatorio Financeiro';
        $mail->Body = 'Você está recebendo um relatório gerado pelo site  <b> Controlei.pe.hu!</b>'
                . '<br> Qualquer dúvida entre em contato.';
        $mail->AltBody = 'Você recebeu um relatório com os seus dados financeiros.';

        if (!$mail->send()) {
            echo 'Erro ao enviar.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Mensagem enviada com sucesso';
        }
    }

    function geraPdf() {

        $usuario = $this->session->get('nome');
        $receita = $this->session->get('somar');
        $despesa = $this->session->get('somad');
        $saldo = $receita - $despesa;

        $today = getdate();
        $dia = $today['mday'];
        $m = $today['mon'];
        $a = $today['year'];
        $usuario = $this->session->get('nome');

        header("Content-Type: text/html; charset=ISO-8859-1", true);
        date_default_timezone_set('America/Sao_Paulo');
        setlocale(LC_ALL, "pt-BR");

        $mes = strftime("%B");
        $data = strftime("%d de " . ucfirst($mes) . " de %Y, %H:%M");

        $resumo = "<hr>"
                . "<table border='0' width='100%'><tr><td id='receita'>Receita<br> <h2> R$ " . number_format($receita,2,',','.') . "</h2></td> <td id='despesa'> "
                . "Despesa<br> <h2'> R$ " . number_format($despesa,2,',','.'). "</h2></td>  <td id='saldo'> Saldo<br><h2> R$ " . number_format($saldo,2,',','.'). "</h2></td> </tr></table>";


        $receita_pdf = '<table border="1" width="100%">';
        $receita_pdf .= '<thead>';
        $receita_pdf .= '<tr>';
        $receita_pdf .= '<th>Receitas</th>';
        $receita_pdf .= '<th>Valor</th>';
        $receita_pdf .= '<th>Data de lançamento</th>';
        $receita_pdf .= '</tr>';
        $receita_pdf .= '</thead>';
        $receita_pdf .= '<tbody>';

        $dadosReceita = $this->modeloReceita->listaItemPorMes($m, $a, $this->session->get('id_user'));

        foreach ($dadosReceita as $d_receita) {
             $d = new \DateTime($d_receita['data_lanc_rec']);
            $receita_pdf .= '<tr><td>' . $d_receita['tipo_rec'] . "</td>";
            $receita_pdf .= '<td>R$ ' .  number_format($d_receita['valor_rec'],2,',','.') . "</td>";
            $receita_pdf .= '<td>' . $d->format('d/m/Y') . "</td>";

        }
        $receita_pdf .= '</tbody>';
        $receita_pdf .= '</table> <br>';
        
        
        
        $despesa_pdf = '<table border="1" width="100%">';
        $despesa_pdf .= '<thead>';
        $despesa_pdf .= '<tr>';
        $despesa_pdf .= '<th>Despesas</th>';
        $despesa_pdf .= '<th>Valor</th>';
        $despesa_pdf .= '<th>Data de vencimento</th>';
        $despesa_pdf .= '</tr>';
        $despesa_pdf .= '</thead>';
        $despesa_pdf .= '<tbody>';

        $dadosDespesaPdf = $this->modeloDespesa->listaItemPorMes($m, $a, $this->session->get('id_user'));

        foreach ($dadosDespesaPdf as $d_despesa) {
            $d = new \DateTime($d_despesa['data_venc_desp']);
            $despesa_pdf .= '<tr><td>' . $d_despesa['descricao_desp'] . "</td>";
           $despesa_pdf .= '<td>R$ ' . number_format($d_despesa['valor_desp'],2,',','.') . "</td>";
            $despesa_pdf.= '<td>' . $d->format('d/m/Y') . "</td>";

        }
       $despesa_pdf .= '</tbody>';
        $despesa_pdf .= '</table>';


        $paginaCompleta = '<!doctype html> <html> <head> <link rel="stylesheet" type="text/css" href="css/estilo-pdf.css"> </head> <body> '
                . ' <div id="cabecalho">'
                . '<h1> Situação Financeira de ' . $usuario . '</h1>Gerado em ' . $data . ''
                . '</div> '
                . '<div>'
                . ' ' . $resumo . ' '
                . '</div>'
                . '<div>'
                . ''.$receita_pdf.''
                . '</div>'
                  . '<div>'
                . ''.$despesa_pdf.''
                . '</div>'
                . '<br><br><div id="footer"> Gerado por Controle Financeiro - 2017<br>'
                . 'Ajudando você a ser mais livre...'
                . '</div>'
                . '</body>'
                . '</html>';

        Funcoes::geraPdf($paginaCompleta);
    }

}
