<?php

class Post
{
    // DB stuff
    private $conn;
    private $table = 'posts';
    // Post Properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // Constructor with DB
    // constructors need to have the __construct identifier
    public function __construct($db)
    {
        $this->conn = $db;
    }


    // Get Posts
    public function read()
    {

        // Create read query
        // FROM ' . $this->table . ' p
        // this->table means Post, because we are in the post class, Post is then assigned to p
        // categories c = we assign categories to c here
        // the join occurs on p.category_id = c.id
        $query = 'SELECT c.name as category_name, 
                  p.id, 
                  p.category_id, 
                  p.title, 
                  p.body, 
                  p.author, 
                  p.created_at
                  FROM ' . $this->table . ' p
                  LEFT JOIN
                      categories c 
                  ON 
                      p.category_id = c.id
                  ORDER BY
                      p.created_at DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get Single Post
    // the question mark is a placeholder where we use PDO's bindparam to fill
    public function read_single()
    {
        // Create query
        $query = 'SELECT c.name as category_name, 
                  p.id, 
                  p.category_id, 
                  p.title, 
                  p.body, 
                  p.author, 
                  p.created_at
                  FROM ' . $this->table . ' p
                  LEFT JOIN
                     categories c ON p.category_id = c.id
                  WHERE
                     p.id = ?
                     LIMIT 0,1';


        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        // this is a positional parameter, so we specify that the first parameter (1) will bind to this->id
        // this is different than a named parameter where we specify the name of the parameter we wish to replace, like in our create method, here we designate the replacement based on the position of the parameter we replace in the SQL statement
        // https://www.php.net/manual/en/pdostatement.bindparam.php   ---- the manual explains this perfectly
        $stmt->bindParam(1, $this->id);
        // Execute query
        $stmt->execute();

        // get the row as an associative array
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        // use the values from the associative array and assign them to the Post
        // object that calls this read_single method (which will occur in read_single.php
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }


    // Create Post
    // here we are using named parameters, these are :title, :body etc, we will fill this values in later using the bindParam function
    public function create() {
        // Create query
        $query =
            'INSERT INTO ' . $this->table . ' 
                SET 
                    title = :title, 
                    body = :body, 
                    author = :author, 
                    category_id = :category_id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        // strip_tags removes HTML and php tags from the string
        // htmlspecialchars will convert special characters to HTML entities
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }


    // Update Post
    public function update() {
        // Create query
        $query =
                                'UPDATE ' . $this->table . '
                                SET title = :title, 
                                            body = :body, 
                                            author = :author, 
                                            category_id = :category_id
                                WHERE id = :id';
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }


    // Delete Post
    public function delete() {
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