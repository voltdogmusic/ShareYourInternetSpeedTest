<?php

//$ip = var_dump(getenv('PATH'));
//
//echo $ip; //this prints out stuff, proving that getenv will work


$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

echo $url . ' look, we got string concat ' . $url; //currently it's only printing array

$server = $url["host"];
echo $server;
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);

