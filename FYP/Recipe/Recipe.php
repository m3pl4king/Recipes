<?php

include 'conn.php';
session_start();

/*
   Fetch Recipe data from db(table: recipes) and loads it into $array for further use ... DONE
*/

$recipe_id_queried = (int)$_GET['id'];
$array = array();

$sql = "SELECT r.recipe_id, l.username, r.recipe_name, r.filename, r.ingredient_name, r.steps
         FROM recipes AS r INNER JOIN login AS l 
         WHERE r.user_id = l.user_id AND r.recipe_id = $recipe_id_queried";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
   $row = mysqli_fetch_array($result);
   $array['recipe_id'] = $row['recipe_id'];
   $array['username'] = $row['username'];
   $array['recipe_name'] = $row['recipe_name'];
   $array['filename'] = $row['filename'];
   $array['ingredient_name'] = $row['ingredient_name'];
   $array['steps'] = $row['steps'];
} else {
   header('Location: Error.html');
}

/* 
   Fetch category data from db(table: category_input) and loads it into $array for further use ... DONE
*/

$sql = "SELECT c.category_name FROM category AS c INNER JOIN category_input AS b ON c.category_id = b.category_id WHERE b.recipe_id = $recipe_id_queried";
$result = mysqli_query($conn, $sql);

$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
$array['category_name'] = array_column($rows, "category_name");


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
   /*echo "
         <script>
            alert ('Log in to add to favourites');
         </script>
         ";
         
   header('Location: Error.html');
   */
} 

else { // Fetches user_id for future use ... DONE
   $result = mysqli_query($conn, "SELECT user_id FROM login WHERE email = '$email'");
   $user_id = mysqli_fetch_array($result)[0]; 
}

/*
   $sql = "INSERT INTO `favourites` (`user_id`, `recipe_id`,) VALUES ('$user_id','$recipe_id_queried')";
   $result = mysqli_query($conn, $sql);
*/

/*
   checkFavorite
*/
function checkFavourite($recipe_id, $user_id, $conn) { // ok. just ensure pass parameters (Line 18-25) $array['recipe_id'] and (Line 64-66) $user_id
   $sql = "SELECT * FROM Favourites WHERE recipe_id = '".$recipe_id."' AND user_id = '".$user_id."'";
   $result = mysqli_query($conn, $sql);
   $numrows = mysqli_num_rows($result);
      if ($numrows == 0) {
         echo "
            <div class='button' method ='Like' recipe_id=".$recipe_id." user_id=".$user_id."> 
               <img id=".$user_id." src='favoff.png'> 
            </div>
         ";
         echo "<span id='favText'>Click to add to Favourites </span>";
      } 
      else {
         echo "
            <div class='button' method='Unlike' recipe_id=".$recipe_id." user_id=".$user_id." > 
               <img id=".$user_id." src='favon.png'> 
            </div>
         ";
         echo "<span id='favText'> Favourited! </span>";
      }
   }
?>