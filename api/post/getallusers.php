<?php

// MY FILE, DOESN'T WORK, TRYING TO ACCESS ALL USERS FROM DATABASE


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/User.php';


$database = new Database();
$db = $database->connect();


$user = new User($db);
$result = $user->read();
$num = $result->rowCount();

if ($num > 0) {

    $user_arr = array();
    $user_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $user_item = array(
            'id' => $id,
            'email' => $email,
            'password' => $password
        );

        array_push($user_arr['data'], $user_item);
    }

    // Turn to JSON & output
    echo json_encode($user_arr);

} else {
    // No Posts
    echo json_encode(
        array('message' => 'No Users Found')
    );
}
