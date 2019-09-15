<?php

class Database
{

     //private $host = 'us-cdbr-iron-east-02.cleardb.net';
     //private $db_name = 'heroku_74da0c35df50742';
     //private $username = 'b80d61794837eb';
     //private $password = '9af4c84a';


    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    // DB Connect
    // https://www.php.net/manual/en/pdo.construct.php
    // $dbh = new PDO($dsn, $user, $password);
    // a dsn will look like this -> pdo.dsn.mydb="mysql:dbname=testdb;host=localhost"
    // there is a semicolon in the string above, so you need to make sure to add the semicolon within the dsn
    public function connect()
    {

        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

        $this->host = $url["host"];
        $this->username = $url["user"];
        $this->password = $url["pass"];
        $this->db_name = substr($url["path"], 1);

        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }



//    private $conn;
//
//
//    // My code for clearDB database, need to set up if statement here for local development
//    public function connect()
//    {
//
//        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
//
//        $server = $url["host"];
//        $username = $url["user"];
//        $password = $url["pass"];
//        $db = substr($url["path"], 1);
//
//        //$conn = new mysqli($server, $username, $password, $db);
//
//        $this->conn = null;
//        try {
//            $this->conn = new PDO('mysql:host=' . $server . ';dbname=' . $db, $username, $password);
//            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//        } catch (PDOException $e) {
//            echo 'Connection Error: ' . $e->getMessage();
//        }
//        return $this->conn;
//    }



}






