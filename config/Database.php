<?php

class Database
{

    /* This is brads code for a local sql database
    // DB Params
    private $host = '127.0.0.1';
    private $db_name = 'myblog';
    private $username = 'root';
    private $password = 'password';
    private $conn;

    // DB Connect
    // https://www.php.net/manual/en/pdo.construct.php
    // $dbh = new PDO($dsn, $user, $password);
    // a dsn will look like this -> pdo.dsn.mydb="mysql:dbname=testdb;host=localhost"
    // there is a semicolon in the string above, so you need to make sure to add the semicolon within the dsn
    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
    */


    private $conn;
    // My code for clearDB database
    public function connect()
    {

        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

        $server = $url["host"];
        $username = $url["user"];
        $password = $url["pass"];
        $db = substr($url["path"], 1);

        //$conn = new mysqli($server, $username, $password, $db);


        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:host=' . $server . ';dbname=' . $db, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }


        echo 'Connected ';
        return $this->conn;
    }
}






