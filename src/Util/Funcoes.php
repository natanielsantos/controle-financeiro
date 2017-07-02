<?php

namespace ControleFinanceiro\Util;

use Dompdf\Dompdf;
use PHPMailer;
use ControleFinanceiro\Models\ModeloUsuario;

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
        $modeloUsuario = new ModeloUsuario();
        
        $hash = $dados['hash']['hash'];
        $idUsuario = $dados['hash']['id_usuario'];
        
        $usuario = $modeloUsuario->getUsuario($idUsuario);
        $email = $usuario['email'];
        $user = $usuario['usuario'];
        
        //$mail->SMTPDebug = 2;                            

        $mail->isSMTP();                                      
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;                               
        $mail->Username = 'controlei.trabalho@gmail.com';                
        $mail->Password = '943491el!!';                          
        $mail->SMTPSecure = 'tls';                         
        $mail->Port = 587;                                   

        $mail->setFrom('controlei.trabalho@gmail.com', 'Controlei.pe.hu');
        $mail->addAddress($email, $user);    

        $mail->isHTML(true);                                

        $mail->Subject = 'Controlei - Chave de ativacao';
        $mail->Body = 'Você está recebendo uma chave de ativação para o seu usuário'
                . '<br><a href="controlefinanceiro.com.br/codigo='.$hash.'">Clique aqui para ativar sua conta</a>';
        $mail->AltBody = 'Seja bem vindo ao Controlei!.';

        if (!$mail->send()) {
            $mensagem = 'Erro ao enviar.';
            $mensagem .= 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $mensagem = 'Chave gerada e enviada com sucesso. Verifique o seu email e clique no link de ativação para liberar seu acesso.';
        }
        
        return $mensagem;
    }

}

//