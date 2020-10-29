<?php

  // Create connection (servername, username, password, dbname)
  $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  //variables
  $name = $_POST['name']; //required
  $email = $_POST['email']; //required
  $username = $_POST['username']; //required
  $password = $_POST['password']; //required
  $cpassword = $_POST['confirmpassword']; //required
  $inserted = 0;

  // set auto-increment for INSERT statements
  $ai = "ALTER TABLE user_randa AUTO_INCREMENT = 1";
  $run = mysqli_query($conn, $ai);

  // need to validate: username taken blaaah etc.-------------------------------------!!!

  // md5 example: 123 -> 202cb962ac59075b964b07152d234b70
  if($password == $cpassword){
    $password = md5($password);

    // insert to user_randa
    $sql = "INSERT INTO user_randa (user_name, user_email, user_username, user_password)
    VALUES ('$name', '$email', '$username', '$password')";

    if ($inserted = mysqli_query($conn, $sql)) {
      $inserted = 3;
      // echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
  else{
    echo "passwords dont match";
  }

  header("Location:../index.php?page=registerUser&status=" . $inserted);

  mysqli_close($conn);

?>
