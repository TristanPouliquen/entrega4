<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Silex\Application;

$app = require __DIR__.'/bootstrap.php';

$app->get('/', function(Application $app){
  $xml = simplexml_load_file("http://jreutter.sitios.ing.uc.cl/alias.xml");
  $result = $xml->xpath("//tr[position()>1]/td[1]");
  $documents = array();
  $aliases = array();
  foreach($result as $element){
    array_push($aliases, $element->__toString());
  }
  foreach ($aliases as $alias) {
    $url = "http://query17-8.ing.puc.cl/wordInContent?keyword=" + $alias;
    $json = file_get_contents($url);
    var_dump($json);
    die;
    $documents[$alias] = json_decode($json);
  }
  return $app['twig']->render("index.html.twig", [
    'aliases' => $result,
    'messages' => $documents
  ]);
})->bind('index');

$app->get('/api', function(Application $app){
  return $app['twig']->render("apidoc.html.twig");
})->bind("apidoc");

$app->run();
