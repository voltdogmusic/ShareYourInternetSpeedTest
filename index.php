<?php

require('./vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => 'php://stderr',
));


// http://localhost/BradRestApi/index.php will redirect the vanilla path to views/index.html
 https://hidden-brushlands-71469.herokuapp.com also uses this to redirect to index.html
$app->get('/', function () use ($app) {
    return $app->sendFile(__DIR__.'/views/index.html');
});


$app->get('/cowsay', function() use($app) {
    $app['monolog']->addDebug('cowsay');
    return "<pre>".\Cowsayphp\Cow::say("Cool beans")."</pre>";
});


$app->get('/myview', function () use ($app) {
    //$app['monolog']->addDebug('myview');
    return $app->sendFile(__DIR__.'/views/myview.html');
});


$app->run();
