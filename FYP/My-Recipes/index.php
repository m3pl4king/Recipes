<!DOCTYPE html>
<html>
<head>
  <title>My Recipe</title>
  <style><?php include 'My-Recipes.css'; ?></style>
  <link rel="stylesheet">
</head>

<body>

<?php 
  include 'conn.php';
  session_start();
?>

    <div class="header">
      <div id="home">
          <div class="navbackground">
              <div class="container">
                  <div class="navbar">
                      <div class="logo">
                          <img src="../FYP-Images/ChilliAss.png" width="124" length="164">
                      </div>
                        <div class="text">
                          <h1>Secrets of Malaysian</h1>
                        </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

    <div class="menu">
    <ul class="menu">
    <li><a id = "acc" href="../Accounts/index.php">Profile Page</a></li>
    <li><a id = "recipe" class = "active" href="index.php">My Recipes</a></li>
    <li><a id = "favourited" href="../My-Favourites/index.php">My Favourites</a></li>
    <li><a id = "create" href="../Create-Recipe.html">Create Recipe</a></li>
    </ul>
    </div>
    
    <table width = "70%">
      <tr>
        <th>Image </th>
        <th>Recipe Name</th>
      </tr>
      
<?php
  $user_id = $_SESSION['login_user'];
  $array = array();

    if ($conn-> connect_error){
      die("Connection failed: ". $conn-> connect_error);
    }

    $sql = "SELECT r.recipe_id, r.recipe_name, r.filename FROM recipes AS r WHERE user_id IN (SELECT user_id FROM login WHERE email = '" . $_SESSION['login_user'] . "')";

    $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0){
      while ($row =  mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $array['recipe_id'] = $row['recipe_id'];
        $array['recipe_name'] = $row['recipe_name'];
        $array['filename'] = $row['filename'];
        $image = "../uploads/".$array['filename'];
        $recipe_url = "http://localhost/FYP/Recipe/index.php?id=" . $array['recipe_id'];
        
        echo '<tr class = "cursor"><td style><div class = "clickable"><a href = "'.$recipe_url.'" ">' . '<img class = "resize" src ="'.$image.'">' .  '</td></div></a><td><div class = "clickable"><a href = "'.$recipe_url.'" ">' . $row['recipe_name'] ."</div></td></tr></a>"  ;
      }
      
      echo "</table>";

      } else {
          echo "You have no recipes created";
      }
      
      
      ?>
    </table>


  </body>
</html>