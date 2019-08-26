<?php

require('./vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

$app->get('/', function () use ($app) {
    return $app->sendFile(__DIR__.'/views/index.html');
});

$app->run();
