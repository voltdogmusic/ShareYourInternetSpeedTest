<?php
class User
{
// DB stuff
    private $conn;
    private $table = 'users';
// Post Properties
    public $id;
    public $email;
    public $password;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {

        $query = 'SELECT * FROM users';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

}
