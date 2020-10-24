<?php

  // Create connection (servername, username, password, dbname)
  $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  //variables
  $username = $_POST['username']; //required
  $password = $_POST['password']; //required
  $exist = 0;
  // md5 example: 123 -> 202cb962ac59075b964b07152d234b70

  // get existing username and password from db
  $sql = "SELECT * FROM user_randa WHERE user_username = '$username'";
  $run = mysqli_query($conn, $sql);

  if( mysqli_num_rows($run) > 0 ){ // check if username is in db
    $row = mysqli_fetch_assoc($run);
    $dbpassword = $row['user_password'];
    if( $dbpassword == md5($password) ){ // check if password match
      $exist = 1;
      // echo $sql;
      // set session
      session_start();
		  $_SESSION['userid'] = $row['user_id'];
      $_SESSION['username'] = $row['user_username'];
      // header("Location:../account.php");
    }
    else{
      // echo $sql . "<br>incorrect password<br>" . $exist;
      // header("Location:../index.php?page=loginUser&status=" . $exist);
    }
  }
  else{
    // echo "incorrect username " . mysqli_error($conn) . $sql . "<br>DBpw: " . $dbpassword . "<br>Pw: " . md5($password) . "<br>" . $exist;
    // header("Location:../index.php?page=loginUser&status=" . $exist);
  }

  header("Location:../index.php?page=loginUser&status=" . $exist);
  mysqli_close($conn);

?>
