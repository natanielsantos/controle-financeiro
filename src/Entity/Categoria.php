<?php

namespace ControleFinanceiro\Entity;

class Categoria {

    private $id = null;
    private $nome;
    private $descricao;
    private $usuario;

    function __construct($nome, $descricao, $usuario) {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->usuario = $usuario;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

}
