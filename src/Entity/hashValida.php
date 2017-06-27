<?php

namespace ControleFinanceiro\Entity;

class hashValida {

    public function validar($data, $horasExpiracao) {
        $dados = array();
        date_default_timezone_set('America/Sao_Paulo');
        $dataRegistro = new DateTime($data);
        $dataAtual = new DateTime();
        $diferenca = $dataAtual->diff($dataRegistro);
        $diferencaHoras = $diferenca->h + ($diferenca->days * 24);

        if ($diferencaHoras < $horasExpiracao) {
            $dados['status'] = 'sucesso';
            $dados['horas'] = $diferencaHoras;
            $dados['mensagem'] = 'Ativado com sucesso';
        } else {
            $dados['status'] = 'erro';
            $dados['mensagem'] = 'Prazo para ativação expirado';
        }

        return $dados;
    }

}
