<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Silex\Application;

$app = require __DIR__.'/bootstrap.php';

$app->get('/', function(Application $app){
  return new Response("Hola");
});

$app->get('/api.html', function(Application $app){
  return $app['twig']->render("apidoc.html.twig");
});

$app->run();
