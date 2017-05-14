<?php

namespace ControleFinanceiro;

// configura o COMPOSER
require_once __DIR__ . '/../vendor/autoload.php';

//adiciona o arquivo de rotas
include 'routes.php';

//lista de pacotes utilizados
use Whoops;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use ControleFinanceiro\Util\Session;

//criar a sessão
$sessao = new Session();
$sessao->start();

// configura o WHOOPS para mostrar erros amigáveis
$whoops = new Whoops\Run();
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler);
$whoops->register();


//if ($logado != null) { // colocar != de null para ativar login
  //  require_once 'login.html';
//} else {

// configurar o http-foundation
    $resposta = new Response();
    $requisitaContexto = new RequestContext();
    $request = Request::createFromGlobals();
    $requisitaContexto->fromRequest($request);
    $urlMatcher = new UrlMatcher($rotas, $requisitaContexto);
    $atributos = $urlMatcher->match($requisitaContexto->getPathInfo()); //armazena a rota com todos os atributos
//configura o twig para utilização de templates
    $carregar = new \Twig_Loader_Filesystem(__DIR__ . '/View');
    $twig = new \Twig_Environment($carregar);

// configura para reconhecer os controladores
    $controlador = new $atributos['_controller']($resposta, $request, $twig); //busca um controlador dentro dos atributos

    if (isset($atributos['_method'])) {
        $metodo = $atributos['_method'];
        if (isset($atributos['_param']))
            $controlador->$metodo($atributos['_param']);
        else
            $controlador->$metodo();
    }

    $resposta->send();
//}

