<?php

use Silex\Application;
use Silex\Provider\MonologServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\TwigServiceProvider;


$app = new Application();

// enable the debug mode
$app['debug'] = true;
$app->register(new MonologServiceProvider(), array(
  'monolog.logfile' => __DIR__.'/var/log/development.log',
));

$app->register(new TwigServiceProvider());
$app['twig.path'] = array(realpath(__DIR__.'/views'));
$app['twig.options'] = array(
  'cache' => __DIR__.'/var/cache/twig',
  'auto_reload' => true
);

$app->register(new DoctrineServiceProvider(), [
    'dbs.options' => [
        'grupo37' => [
            'driver'    => 'pdo_pgsql',
            'host'      => 'localhost',
            'dbname'    => 'grupo37',
            'user'      => 'grupo37',
            'password'  => 'grupo37',
        ],
        'grupo40' => [
            'driver'    => 'pdo_pgsql',
            'host'      => 'localhost',
            'dbname'    => 'grupo40',
            'user'      => 'grupo40',
            'password'  => 'grupo40',
        ],
    ],
]);

$app->register(new DoctrineOrmServiceProvider, [
    'orm.ems.options' => [
        'grupo37' => [
            'connection' => 'grupo37',
            'mappings' => [
                [
                    'type' => 'yml',
                    'namespace' => 'Entity37',
                    'path' => __DIR__ . '/../config/doctrine/grupo37'
                ]
            ]
        ],
        'grupo40' => [
            'connection' => 'grupo40',
            'mappings' => [
                [
                    'type' => 'yml',
                    'namespace' => 'Entity40',
                    'path' => __DIR__ . '/../config/doctrine/grupo40'
                ]
            ]
        ]
    ],
    'orm.proxies_dir' => __DIR__.'/../var/cache/doctrine/proxies'
]);

return $app;
