<?php

class User{

}


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

//$sql = "SELECT id,email,password FROM users";
$sql = "SELECT * FROM users";

$result = $conn->query($sql);

if ($result->num_rows > 0) {


    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["email"]. " " . $row["password"]. "<br>";
    }



} else {
    echo "0 results";
}
$conn->close();

