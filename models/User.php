<?php

class User
{
    private $conn;
    private $table = 'users';
    public $id;
    public $email;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllUsers()
    {

        $query = 'SELECT * FROM  '.$this->table.'';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function getSingleUser()
    {
        $query = 'SELECT * FROM '.$this->table.' WHERE id=? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // now the object created within getsingleuser.php has access to all of these variables
        $this->id = $row['id'];
        $this->email = $row['email'];
        $this->password = $row['password'];

        // unlike getAllUsers, we will grab the data from the sql query here first using FETCH_ASSOC, instead of returning the stmt to getsingleuser.php
        // $this->id field will be set in getsingleuser.php via
        // $user->id = isset($_GET['id']) ? $_GET['id'] : die();
    }

    public function createUser(){
        $query =
            '
                  INSERT INTO 
                    '.$this->table.'
                  SET 
                    email = :email, 
                    password = :password            
             ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function updateUser(){
        $query =
            '
                  UPDATE 
                     '.$this->table.'
                  SET 
                    email = :email, 
                    password = :password
                  WHERE     
                    id = :id              
             ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':id', $this->id);


        // If stmt executes, return true, else print an error +
        // return false
        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function deleteUser() {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' 
                  WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
