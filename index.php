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
 https://hidden-brushlands-71469.herokuapp.com also uses this to redirect to index.html
$app->get('/', function () use ($app) {
    return $app->sendFile(__DIR__.'/views/index.html');
});


$app->get('/cowsay', function() use($app) {
    $app['monolog']->addDebug('cowsay');
    return "<pre>".\Cowsayphp\Cow::say("Cool beans")."</pre>";
});


$app->get('/myview', function () use ($app) {
    return $app->sendFile(__DIR__.'/views/myview.html');
});


$app->get('/readall', function () use ($app) {
    return $app->sendFile(__DIR__.'/api/post/read.php');
});




$app->get('/read', function () use ($app) {
    return 'read';
});

$app->run();
