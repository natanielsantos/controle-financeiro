<?php

namespace ControleFinanceiro\Entity;

class Hash{
	private $id;
	private $hash;
	private $status;
	private $idusuario;
	private $datacadastro;

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setHash($hash){
		$this->hash = $hash;
	}

	public function getHash(){
		return $this->hash;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setIdUsuario($idusuario){
		$this->idusuario = $idusuario;
	}

	public function getIdUsuario(){
		return $this->idusuario;
	}

	public function setDataCadastro($datacadastro){
		$this->datacadastro = $datacadastro;
	}

	public function getDataCadastro(){
		return $this->datacadastro;
	}
}
