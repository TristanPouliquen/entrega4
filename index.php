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
    $url = urlencode("http://query17-8.ing.puc.cl/wordInContent?keyword=\"" . $alias . "\"");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 4);
    if( ! $json = curl_exec($ch))
    {
        $json = curl_error($ch);
    }
    $documents[$alias] = json_decode($json);
    curl_close($ch);
  }
  return $app['twig']->render("index.html.twig", [
    'aliases' => $aliases,
    'messages' => $documents
  ]);
})->bind('index');

$app->get('/api', function(Application $app){
  return $app['twig']->render("apidoc.html.twig");
})->bind("apidoc");

$app->run();

function curl_get($url, array $get = NULL, array $options = array())
{
    $defaults = array(
        CURLOPT_URL => $url. (strpos($url, '?') === FALSE ? '?' : ''). http_build_query($get),
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_TIMEOUT => 4
    );

    $ch = curl_init();
    curl_setopt_array($ch, ($options + $defaults));
    if( ! $result = curl_exec($ch))
    {
        trigger_error(curl_error($ch));
    }
    curl_close($ch);
    return $result;
}
