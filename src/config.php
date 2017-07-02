<?php

namespace ControleFinanceiro;

require_once __DIR__ . '/../vendor/autoload.php';


include 'routes.php';


use Whoops;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use ControleFinanceiro\Util\Session;


$session = new Session();
$session->start();


$whoops = new Whoops\Run();
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler);
$whoops->register();


$resposta = new Response();
$requisitaContexto = new RequestContext();
$request = Request::createFromGlobals();
$requisitaContexto->fromRequest($request);
$urlMatcher = new UrlMatcher($rotas, $requisitaContexto);
$atributos = $urlMatcher->match($requisitaContexto->getPathInfo());


$carregar = new \Twig_Loader_Filesystem(__DIR__ . '/View');
$twig = new \Twig_Environment($carregar);


$controlador = new $atributos['_controller']($resposta, $request, $twig, $session);

if (isset($atributos['_method'])) {
    $metodo = $atributos['_method'];
    if (isset($atributos['_param'])) {
        $controlador->$metodo($atributos['_param']);
    } else {
        $controlador->$metodo();
    }
}

$resposta->send();
//}

