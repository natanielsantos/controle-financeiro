<?php

namespace ControleFinanceiro\Entity;

class Usuario {

    private $id = null;
    private $nome;
    private $senha;
    private $email;
    private $status;

    function __construct($nome, $senha, $email, $status) {
        $this->nome = $nome;
        $this->senha = $senha;
        $this->email = $email;
        $this->status = $status;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getSenha() {
        return $this->senha;
    }

    function getEmail() {
        return $this->email;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setStatus($status) {
        $this->status = $status;
    }

}
