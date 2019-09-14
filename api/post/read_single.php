<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object (this is from the Post.php class)
$post = new Post($db);

// Get ID from URL
// isset Returns TRUE if var exists and has any value other than NULL. FALSE otherwise.
// we use the $_GET global variable to get the id from the URL
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get a single post
$post->read_single();
// Create array
$post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name
);

// Make JSON
print_r(json_encode($post_arr));