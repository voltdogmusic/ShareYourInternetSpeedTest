<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';

//$database = new Database();
//$db = $database->connect();
//
//if ($db->connect_error) {
//    die("Connection failed: " . $db->connect_error);
//}

// REPLACE THIS WITH DATABASE OBJECT
$servername = "us-cdbr-iron-east-02.cleardb.net";
$username = "b80d61794837eb";
$password = "9af4c84a";
$dbname = "heroku_74da0c35df50742";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json") {

    $content = trim(file_get_contents("php://input"));

    $decoded = json_decode($content, true);

    $postVariable = $decoded["postBody"];

    //If json_decode failed, the JSON is invalid.
    if(! is_array($decoded)) {

    } else {
        // Send error back to user.
    }
}

// could use an array of flip values for each post variable, then if its false set the sql statement to the opposite (desc/asc)


$sql =
    "SELECT download, upload, ping, jitter, location, carrier FROM speedform ORDER BY $postVariable";

$result = $conn->query($sql);

// REPLACE THIS WITH read.php,return JSON then use the JSON in HTML
//if ($result->num_rows > 0) {
//
//    while($row = $result->fetch_assoc()) {
//        echo
//             "<tr><td>" . $row["download"].
//             "</td><td>" . $row["upload"].
//             "</td><td>" . $row["ping"].
//             "</td><td>" . $row["jitter"].
//             "</td><td>" . $row["location"].
//             "</td><td>" . $row["carrier"].
//             "</td></tr>";
//    }
//    echo "</table>";
//} else { echo "0 results"; }

//echo $_POST['postBody'];

if ($result->num_rows > 0){

    $results_arr = array();
    $results_arr['data'] = array();

    while ($row = $result->fetch_assoc()) {
        extract($row);

        // create a post item to add to the array

        $result_item = array(
            'download' => $download,
            'upload' => $upload,
            'ping' => $ping,
            'jitter' => $jitter,
            'location' => $location,
            'carrier' => $carrier
        );

        //echo $result_item;

        array_push($results_arr['data'], $result_item);
    }

    // Turn to JSON & output
    echo json_encode($results_arr);

}else {
    echo json_encode(
        array('message' => 'generate table failed')
    );
}

