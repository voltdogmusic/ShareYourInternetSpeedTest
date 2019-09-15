<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';



//$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
//
//$servername = $url["host"];
//$username = $url["user"];
//$password = $url["pass"];
//$dbname = substr($url["path"], 1);
//
//// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
//// Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}


$database = new Database();
$conn = $database->connect();

if ($conn->connect_error) {
    die("Connection failed: " . $db->connect_error);
}



// this code takes the body of the request, which is JSON, and makes it readable
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

$sql =
    "SELECT download, upload, ping, jitter, location, carrier FROM speedform ORDER BY $postVariable";

$result = $conn->query($sql);

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

        array_push($results_arr['data'], $result_item);
    }

    // Turn to JSON & output
    echo json_encode($results_arr);

}else {
    echo json_encode(
        array('message' => 'generate table failed')
    );
}


