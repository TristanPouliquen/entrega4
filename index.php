<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

$app = require_once __DIR__.'/bootstrap.php';

$app->get('/api.html', function(Application $app){
  return $app['twig']->render("apidoc.html.twig");
});

$app->run();
