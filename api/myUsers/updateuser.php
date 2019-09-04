<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';

$database = new Database();
$db = $database->connect();

$user = new user($db);

// Get raw posted data
// this line simply grabs the data in the post
// https://www.php.net/manual/en/wrappers.php.php
// php://input is a read-only stream that allows you to read raw data from a request body
$data = json_decode(file_get_contents("php://input"));

$user->id = $data->id;
$user->email = $data->email;
$user->password = $data->password;



// Create post, using method we created in Post.php
if($user->updateUser()) {
    // create an array with a message key and Post Created value, then turn it into json and return it to the user
    echo json_encode(
        array('message' => 'User Updated')
    );
} else {
    echo json_encode(
        array('message' => 'User Not Updated')
    );
}