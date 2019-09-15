<?php
/*

This connected ok, but not actually sure going to check with connect method from Database.php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
*/

include_once '../config/Database.php';
include_once '../models/Post.php';


$db = new Database();
$db->connect();
