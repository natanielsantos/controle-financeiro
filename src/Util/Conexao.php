<?php

namespace ControleFinanceiro\Util;

use PDO;

class Conexao {

    public static $instance = null;

    private function __construct() {
        ;
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host=localhost;dbname=controle_financeiro', 'root', '2039327', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }

        return self::$instance;
    }

}
