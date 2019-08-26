<?php

require('./vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;


// http://localhost/BradRestApi/index.php will redirect the vanilla path to views/index.html
// https://hidden-brushlands-71469.herokuapp.com also uses this to redirect to index.html
$app->get('/', function () use ($app) {
    return $app->sendFile(__DIR__.'/views/index.html');
});



$app->get('/cowsay', function() use($app) {
    $app['monolog']->addDebug('cowsay');
    return "<pre>".\Cowsayphp\Cow::say("Cool beans")."</pre>";
});


$app->get('/readAll', function () use ($app) {

    //return 'Hello';

    return $app->sendFile(__DIR__.'/api/post/read.php');
});

$app->run();
