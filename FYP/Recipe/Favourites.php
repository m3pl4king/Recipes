<?php

include 'conn.php';
session_start();

$method = $_GET['method']; // Get the parameter passed in the Get
$user_id = $_GET['user_id']; // Get the parameter passed in the Get
$recipe_id = $_GET['recipe_id']; // Get the parameter passed in the Get
if ($method == "Like") {
    mysqli_query($conn, "INSERT INTO Favourites (`recipe_id`, `user_id`) VALUES ($recipe_id, $user_id)");
  }
  else {
    mysqli_query($conn, "DELETE FROM Favourites WHERE recipe_id = $recipe_id AND user_id = $user_id");
  }

?>