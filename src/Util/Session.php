<?php

namespace ControleFinanceiro\Util;


class Session {
    function __construct() {
        ;
    }
    
    public function start(){
        return session_start();
    }
    
    public function add($chave, $valor){
        // usei o cf para transformar em bidimensional
        $_SESSION['cf'][$chave]=$valor;
    }
    
    public function get($chave){
        if(isset($_SESSION['cf'][$chave])){
            return $_SESSION['cf'][$chave];
        }else
            return "";
    }
    
    public function rem($chave){
        
        session_unset($_SESSION['cf'][$chave]);
    }
    
    public function destroy(){
        session_unset($_SESSION['cf']);
        session_destroy();
    }
}
