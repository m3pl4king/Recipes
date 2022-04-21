<?php
   include 'conn.php';
   session_start();

   $email = $_POST['email'];
   $password = $_POST['password'];
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      // username and password sent from form 
      $sql = "SELECT user_id FROM login WHERE email = '$email' AND password = '$password'";
      $result = mysqli_query($conn,$sql);
      
      // $count is 1 if there is a match
      $count = mysqli_num_rows($result);
      
      if($count == 1) {
         $_SESSION['login_user'] = $email;
         header('Location: Accounts/index.php');
      }else {
         echo '<script type="text/javascript">';
         echo 'alert("Email or password is incorrect");';
         echo 'window.location.href = "Login-Page.html";';
         echo '</script>';
      }
   }
?>