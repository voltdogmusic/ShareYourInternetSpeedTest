<?php

class Database
{
    // DB Params
//    private $host = '127.0.0.1';
//    private $db_name = 'myblog';
//    private $username = 'root';
//    private $password = 'password';
//    private $conn;


    private $host = 'us-cdbr-iron-east-02.clear                                      db.net';
    private $db_name = 'heroku_74da0c35df50742';
    private $username = 'b80d61794837eb';
    private $password = '9af4c84a';
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
}