<?php

namespace ControleFinanceiro\Entity;

class Despesas {

    private $id = null;
    private $tipo;
    private $valor;
    private $data;
    private $status;
    private $categoria;
    private $pagamento;
    private $usuario;

    function __construct($tipo, $valor, $data, $status, $categoria, $pagamento, $usuario) {
        $this->tipo = $tipo;
        $this->valor = $valor;
        $this->data = $data;
        $this->status = $status;
        $this->categoria = $categoria;
        $this->pagamento = $pagamento;
        $this->usuario = $usuario;
    }

    function getId() {
        return $this->id;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getValor() {
        return $this->valor;
    }

    function getData() {
        return $this->data;
    }

    function getStatus() {
        return $this->status;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getPagamento() {
        return $this->pagamento;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setPagamento($pagamento) {
        $this->pagamento = $pagamento;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

}
