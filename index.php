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

// This servers up a cow, I should delete this later as well as uninstall the package that it came with
$app->get('/cowsay', function() use($app) {
    $app['monolog']->addDebug('cowsay');
    return "<pre>".\Cowsayphp\Cow::say("Cool beans")."</pre>";
});

// Delete this later
$app->get('/myview', function () use ($app) {
    return $app->sendFile(__DIR__.'/views/myview.html');
});

// This servers up the actual code, I don't want that
$app->get('/readall', function () use ($app) {
    return $app->sendFile(__DIR__.'/api/post/read.php');
});

$app->run();
