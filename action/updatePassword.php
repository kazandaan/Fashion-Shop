<?php

  // Create connection (servername, username, password, dbname)
  $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  //variables
  $id = $_POST['userid']; //required [hidden]
  $oldpw = $_POST['oldpassword']; //required
  $newpw = $_POST['newpassword']; //required
  $confirmpw = $_POST['confirmpassword']; //required
  $updated = 0;

  // md5 example: 123 -> 202cb962ac59075b964b07152d234b70

  // need to validate: old and new password not the same blaaah etc.-------------------------------------!!!

  // get existing password from db
  $selectsql = "SELECT * FROM user_randa WHERE user_id = $id";
  $run = mysqli_query($conn, $selectsql);
  $row = mysqli_fetch_assoc($run);
  $dbpw = $row['user_password'];
  if( $dbpw == md5($oldpw)){ // check if old password and password in DB match
    if( $newpw == $confirmpw ){ // check if new password and confirm password match
      $password =  md5($newpw);
      // update Password
      $sql = "UPDATE user_randa SET user_password = '$password' WHERE user_id = $id";
      $updated = mysqli_query($conn, $sql);

    }
    else{
       // echo "<br>Re-confirm new password.";
    }
  }
  else{
    // echo "<br>Old Passwords do not match.";
  }

  if ($updated) {
    // echo $sql;
    // header("Location:../account.php?page=updatePassword&status=" . $updated);
  }
  else {
    // echo "Error updating record: " . mysqli_error($conn) . $sql . $error . "<br>array" . $error_array;

  }

  header("Location:../account.php?page=updatePassword&status=" . $updated);
  mysqli_close($conn);

?>
