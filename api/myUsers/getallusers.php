<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once '../../config/Database.php';
include_once '../../models/User.php';

// Create a new database object, connect to it and give it to a User object
// The database object handles connecting to the database using our connect method, which will return a connection (db), we can use the connection(db) variable to create a User.
// Within the User method
$database = new Database();
$db = $database->connect();
$user = new User($db);

// Now using the user object, we can call on our/its getAllUsers method
// This method returns a statement (stmt) which is created after calling prepare on the sql query
$result = $user->getAllUsers();
$num_rows = $result->rowCount();


// We'll create an array to store our results
// While our sql query result has some rows
// We return a row as an array indexed by its column name using FETCH_ASSOC
// Using extract on the row array, we now have access to the values in the row array as referenced by their associated keys, so using $id we get the value associate with rowArray['id'] = value. This is very similar to destructuring JS.
if ($num_rows > 0) {

    $users_arr = array();
    $users_arr['data'] = array();

    while ($rowArray = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($rowArray);

        $user_item = array(
            'id' => $id,
            'email' => $email,
            'password' => $password
        );

        array_push($users_arr['data'], $user_item);
    }
    // Turn to JSON & output
    echo json_encode($users_arr);


} else {
    echo "0 results";
}



