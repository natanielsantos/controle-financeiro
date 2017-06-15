<?php

namespace ControleFinanceiro\Entity;

class Receitas {

    private $id = null;
    private $tipo;
    private $valor;
    private $data;
    private $status;
    private $usuario;

    function __construct($tipo, $valor, $data, $status, $usuario) {
        $this->tipo = $tipo;
        $this->valor = $valor;
        $this->data = $data;
        $this->status = $status;
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

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

}
