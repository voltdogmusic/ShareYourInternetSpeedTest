<?php

require('./vendor/autoload.php');

$app = new Silex\Application();

// should debug mode actually be on?
$app['debug'] = true;

// Register the monolog logging service
// I think I can remove this since I don't use the logging that much
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => 'php://stderr',
));

// http://localhost/BradRestApi/index.php will redirect the vanilla path to views/index.html
 // https://hidden-brushlands-71469.herokuapp.com also uses this to redirect to index.html
$app->get('/', function () use ($app) {
    return $app->sendFile(__DIR__.'/views/index.html');
});


$app->run();
