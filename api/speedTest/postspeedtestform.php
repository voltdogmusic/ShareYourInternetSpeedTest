<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/SpeedForm.php';

$database = new Database();
$db = $database->connect();

$SpeedForm = new SpeedForm($db);

// assign data to this post object
$SpeedForm->download = $_POST['download'];
$SpeedForm->upload = $_POST['upload'];
$SpeedForm->ping = $_POST['ping'];
$SpeedForm->jitter = $_POST['jitter'];
$SpeedForm->location = $_POST['location'];
$SpeedForm->carrier = $_POST['carrier'];


if ($SpeedForm->ping == NULL) {
    $SpeedForm->ping = NULL;
}

if ($SpeedForm->jitter == NULL) {
    $SpeedForm->jitter = NULL;
}


// Create post, using method we created in Post.php
if ($SpeedForm->postForm()) {
    // create an array with a message key and Post Created value, then turn it into json and return it to the user

//    echo $SpeedForm->download;
//    echo "<br>";
//    echo $SpeedForm->upload;
//    echo "<br>";
//    echo "$SpeedForm->ping";

    echo json_encode(
        array('message' => 'SpeedForm Posted')
    );

    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;

} else {
    echo json_encode(
        array('message' => 'SpeedForm Not Posted')
    );

    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}