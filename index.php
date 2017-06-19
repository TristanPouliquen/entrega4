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
  foreach ($result as $alias) {
    $url = "http://query17-8.ing.puc.cl/wordInContent?keyword=" + $alias[0];
    $ch = curl_init($url);
    $json = curl_exec($ch);
    $documents[$alias[0]] = json_decode($json);
    curl_close($ch);
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
