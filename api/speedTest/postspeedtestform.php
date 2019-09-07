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


//** (this didn't work from a form, only from postman)
// Get raw posted data
// this line simply grabs the data in the post
// https://www.php.net/manual/en/wrappers.php.php
// php://input is a read-only stream that allows you to read raw data from a request body
//$data = json_decode(file_get_contents("php://input"));


// assign data to this post object
$SpeedForm->download = $_POST['download'];
$SpeedForm->upload = $_POST['upload'];
$SpeedForm->ping = $_POST['ping'];
$SpeedForm->jitter = $_POST['jitter'];
$SpeedForm->location = $_POST['location'];
$SpeedForm->carrier = $_POST['carrier'];


// Create post, using method we created in Post.php
if ($SpeedForm->postForm()) {
    // create an array with a message key and Post Created value, then turn it into json and return it to the user
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