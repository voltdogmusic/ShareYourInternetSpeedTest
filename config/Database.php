<?php

class Database
{
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
}






