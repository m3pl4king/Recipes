<?php
  include 'conn.php';

  $email = $_POST['email'];
  $password = $_POST['password'];
  $cfm_password = $_POST['cfm_password'];

  if ($password == $cfm_password) {
    $sql = "SELECT * FROM `login` WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) { // if returns a result, means email already taken
      echo '<script type="text/javascript">';
      echo 'alert("email is already taken");';
      echo 'window.location.href = "Signup-Page.html";';
      echo '</script>';
    } 
    else { // inserts values into db if mysqli_num_rows return 0
      $sql = "INSERT INTO `login` (`email`, `password`) VALUES ('$email', '$password')";
      $result = mysqli_query($conn, $sql);

      // solves for username in the form of 'user' + user_id

      $sql = "SELECT LAST_INSERT_ID()";
      $result = mysqli_query($conn, $sql);
      $username = 'user' . mysqli_fetch_row($result)[0];

      $sql = "UPDATE `login` SET username = '$username' WHERE email = '$email'";
      $result = mysqli_query($conn, $sql);

      echo '<script type="text/javascript">';
      echo 'window.location.href = "Accounts/index.php";';
      echo '</script>';
    }
  } else { // $password != $cfm_password
    echo "Passwords are different.";
  }
?>