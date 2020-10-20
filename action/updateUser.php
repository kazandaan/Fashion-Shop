<?php

  // Create connection (servername, username, password, dbname)
  $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  //variables
  $id = $_POST['userid']; //required [hidden]
  $name = $_POST['name']; //required
  $username = $_POST['username']; //required
  $email = $_POST['email']; //required
  $phone = checkNull($_POST['phone']); //null
  //birthday date
    $date = strtotime($_POST['birthday']);
    if($date != '0000-00-00' || $date != NULL){
      $birthday = date("Y-m-d", $date);
    }
    else{
      $birthday = null;
    }
  $address = $_POST['address']; //null
  $cardno = $_POST['cardno']; //null
  $cardname = $_POST['cadrname']; //null
  $card = $_POST['card']; //null

  $sql = "UPDATE user_randa SET
  user_name = '$name',
  user_username = '$username',
  user_email = '$email',
  user_phone = '$phone',
  user_birthday = '$birthday',
  user_address = '$address',
  user_cardno = '$cardno',
  user_cardname = '$cardname',
  user_card = '$card'
  WHERE user_id = $id";

  $updated = mysqli_query($conn, $sql);
  if ($updated) {
    // echo $sql;
    header("Location:../account.php");
  }
  else {
      echo "Error updating record: " . mysqli_error($conn) . $sql;
  }

  function checkNull($variable){
    if($variable == ""){
      $variable = null;
    }
  }

  mysqli_close($conn);

?>
