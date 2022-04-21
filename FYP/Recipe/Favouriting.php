<?php

include 'conn.php';
session_start();

/*
    ==== ONE ====
    Must always check if Guest or Login User:
        If Guest, do not allow favourite button to appear at all/be clicked in any form
*/

try {
    $email = $_SESSION['login_user'];
} catch (Exception $e) {
    $email = null;
}

if ($email == null) { 
 //fav button opacity: 0;
} 
else {
    $result = mysqli_query($conn, "SELECT user_id FROM login WHERE email = '$email'");
    $user_id = mysqli_fetch_array($result)[0];
}

/*
    ==== TWO ====
    Data entries you require:
    2a. Logined User's user-id -> OBTAINED FROM $_SESSION / MYSQL combination query
    2b. me also want recipeid! from url! :)
*/
$array = array();

   $sql = "SELECT recipe_id FROM favourites WHERE user_id = '$user_id'";

   $result = mysqli_query($conn, $sql);
   

/*
    ==== THREE ====
    Data Entries of Insertion/Deletion Type:
    3a. To keep a count of TOTAL COUNT of favourites on recipe_id, make sure you have a likes = likes + 1 added to recipes table of that recipe_id
    3b. INSERT user_id | recipe_id to favourites table if he clicks favourite button and have word say favourited... beside (how design up to u)
    3c. DELETE user_id | recipe_id from favourites table if he clicks already-highlighted favourite button (it unfavourites it) ... and have word say 'unfavourited' beside...
*/


/*
    ==== FOUR ==== <-- this is the skelly part >:(( even smiley face is unahppyface
Looks like that is all actually


    However, take note that you'll need to sync PART THREE live-mode (unlike other stuff u done b4)
    cough jquery cough ajax cough cough cough *dies*
    or any library of ur choice ^^.
*/

$sql = "SELECT * FROM favourites";
$result = mysqli_query($conn, $sql);

if ($result == 1){
 // UN FAVOURITE THIS PIECE OF SHIT

}else{
 $sql = "INSERT INTO `favourites` (`user_id`, `recipe_id`) VALUES ('$user_id', '$recipe_id')";
 $result = mysqli_query($conn, $sql);

}

?>