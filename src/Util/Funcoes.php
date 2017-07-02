<?php

namespace ControleFinanceiro\Util;

use Dompdf\Dompdf;
use PHPMailer;

class Funcoes {

    // funcão para gerar os meses na barra de filtro
    public static function retornaMes($num) {
        switch ($num) {
            case "1": $mes = "jan";
                break;
            case "2": $mes = "fev";
                break;
            case "3": $mes = "mar";
                break;
            case "4": $mes = "abr";
                break;
            case "5": $mes = "Mai";
                break;
            case "6": $mes = "jun";
                break;
            case "7": $mes = "jul";
                break;
            case "8": $mes = "ago";
                break;
            case "9": $mes = "set";
                break;
            case "10": $mes = "out";
                break;
            case "11": $mes = "nov";
                break;
            case "12": $mes = "dez";
                break;
        }

        return $mes;
    }

    // funcao para calcular o total da receita para aparecer na visão geral
    public static function calculaTotalReceita($vetor) {

        $total = 0;

        foreach ($vetor as $v) {
            $total = $v['valor_rec'] + $total;
        }

        return $total;
    }

    // funcao para calcular o total da despesa para aparecer na visão geral
    public static function calculaTotalDespesa($vetor) {

        $total = 0;

        foreach ($vetor as $v) {
            $total = $v['valor_desp'] + $total;
        }

        return $total;
    }

    // funcao para contar quantos itens possui um vetor
    public static function contaItens($vetor) {

        $qtdItens = count($vetor);

        return $qtdItens;
    }

    public static function geraPdf($html) {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->set_option('defaultFont', 'Courier');
        $dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4');

// Render the HTML as PDF
        $dompdf->render();

// Output the generated PDF to Browser
        $dompdf->stream('teste.pdf');
    }
    
    function enviaHash(Array $dados) {

        $mail = new PHPMailer();
        $hash = $dados['hash']['hash'];
        $idHash = $dados['hash']['id_usuario'];

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
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Controlei - Chave de ativacao';
        $mail->Body = 'Você está recebendo uma chave de ativação para o seu usuário'
                . '<br><a href="controlefinanceiro.com.br/codigo='.$hash.'">Clique aqui para ativar sua conta</a>';
        $mail->AltBody = 'Seja bem vindo ao Controlei!.';

        if (!$mail->send()) {
            $mensagem = 'Erro ao enviar.';
            $mensagem .= 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $mensagem = 'Chave gerada e enviada com sucesso. Verifique o seu email e clique no link de ativação para acessar o sistema';
        }
        
        return $mensagem;
    }

}

//