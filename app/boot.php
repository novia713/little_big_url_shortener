<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// error handling

ErrorHandler::register();

$app->register(new DerAlex\Silex\YamlConfigServiceProvider(__DIR__.'/config.yml'));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(

            'driver' => $app['config']['db']['driver'],
            'host' => $app['config']['db']['host'],
            'dbname' => $app['config']['db']['dbname'],
            'user' => $app['config']['db']['user'],
            'password' => $app['config']['db']['password'],
            'charset' => $app['config']['db']['charset'],

    ),
));

if (1 == $app['config']['debug']) {
    ExceptionHandler::register();
} else {
    ExceptionHandler::register(false);
}
