<!DOCTYPE html>
<html>
<head>
 <title>Accounts</title>
 <style><?php include 'Accounts.css'; ?></style>
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

<div class="menu">
 <ul class="menu">
  <li><a id = "acc" class = "active" href="index.php">Profile Page</a></li>
  <li><a id = "recipe" href="../My-Recipes/index.php">My Recipes</a></li>
  <li><a id = "favourited" href="../My-Favourites/index.php">My Favourites</a></li>
  <li><a id = "create" href="../Create-Recipe.html">Create Recipe</a></li>
 </ul>
</div>

<!--
    After loading HTML/CSS, checks for form submit
-->

<?php
    if(isset($_POST['SubmitButton'])) {
        $submitted_username = $_POST['username'];
        $sql = "UPDATE `login` SET username = '$submitted_username' WHERE email = '" . $_SESSION['login_user'] . "'";
        if (mysqli_query($conn, $sql)) {
            echo "
                <script>
                    alert ('Success!');
                </script>
            ";
        } else {
            echo "Error: " . mysqli_error($conn); 
        }
    }
?>

<!-- 
    Sends user to Login page if not logged in
    else, loads `WHERE email = $email`'s username into $username variable
-->
<?php
    try {
        $email = $_SESSION['login_user'];
    } catch (Exception $e) {
        $email = null;
    }

    if ($email == null) { 
        header('Location: ../Login-Page.html');
    } else {
        $result = mysqli_query($conn, "SELECT username FROM login WHERE email = '$email'");
        $username = mysqli_fetch_array($result)[0];
    }
?>

<br>
<!-- Take user's username and email from database and displays them -->

<div class = "Profile">
    <label>Username: </label>
        <div id = username> 
            <?php echo $username ?>
        </div>
</div>

<br>
<br>

<div class = "Profile">
    <label>E-mail: </label>
        <div id = email>
            <?php echo $email ?>
        </div>
</div>
<br>
<!--
    TODO: Edit button should turn the above two .div classes into editable forms
    using .js and DOM manipulation through javascript
    Submit button will post said data into a .php submit form and then
    redirects user back to this page.

    Edit password/confirm password should also appear.
-->

<!-- display form to update username -->

 
<form action="" method="post">

<div class = "username" id = "userEdit">
    <label>Username: </label> <input type="text" name="username" required> 
    <br>
    <input type="submit" value="Update" name="SubmitButton">
    </div>
</form>    


<!-- make the form visable after clicking edit profile button -->
<script>
    function turnVisible(){
        document.getElementById("userEdit").style.opacity = "1.0";
    }
</script>

<button type="button" onclick="turnVisible()">Edit Profile</button>
<br>

<a href= "logout.php">Logout</a>

</body>
</html>