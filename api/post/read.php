<?php

// http://localhost/BradRestApi/api/post/read.php

// Headers
// allows access from anyone
header('Access-Control-Allow-Origin: *');
// MIME type, we will accept json
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';


// Instantiate DB & connect
$database = new Database();
// call the connect function that we created within the Database.php class
// we included this class above so we have access to all of the code
$db = $database->connect();


// Instantiate blog post object (this is from the Post.php class)
$post = new Post($db);
// Blog post query, created in Post.php, here we created the join query, which is why we can see the category_name field
$result = $post->read();
// Get row count
$num = $result->rowCount();


// Check if any posts, take the posts and create a new array with them, then turn them into json
if ($num > 0) {

    // if there are posts, create an array
    // Post array
    $posts_arr = array();
    $posts_arr['data'] = array();


    // while there is a next row to fetch, fetch the next row as an array indexed by column name
    // thus the row variable is an associative array indexed by column name
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        // create a post item to add to the array
        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        );

        // Push to "data"
        //array_push($posts_arr, $post_item);
        array_push($posts_arr['data'], $post_item);
    }


    // Turn to JSON & output
    echo json_encode($posts_arr);


} else {
    // No Posts
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}



/*
  FETCH ASSOC

      https://www.php.net/manual/en/pdostatement.fetch.php

      PDO::FETCH_ASSOC: Return next row as an array indexed by column name

            Array
            (
                [name] => apple
                [colour] => red
            )

    extract() - I think this is basically php's version of destructuring in a way. It allows you to reference values in                 an array by its key name, but you can write the key name as a variable.

        https://www.php.net/manual/en/function.extract.php

            $size = "large";
            $var_array = array("color" => "blue",
                       "size"  => "medium",
                       "shape" => "sphere");

            extract($var_array, EXTR_PREFIX_SAME, "wddx");

            echo "$color, $size, $shape, $wddx_size\n";

    //echo output blue , large, sphere, medium
 */







