<?php

  // Create connection (servername, username, password, dbname)
  $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  //variables
  if( isset($_GET['checkoutid']) ){
    $checkoutid = $_GET['checkoutid'];
  }

//change
  if($userid == ""){
    header("Location:" . $_SERVER['HTTP_REFERER']);
  }

  $sql = "DELETE FROM checkoutDetails_randa WHERE checkout_id = $checkoutid";
  if(mysqli_query($conn, $sql)){
    $sql = "DELETE FROM checkout_randa WHERE checkout_id = $checkoutid";
    $execute = mysqli_query($conn, $sql);
  }

  if($execute){
    header("Location:../orders.php");
    // header("Location:" .  $_SERVER['HTTP_REFERER'] );
  }
  else{
    echo "could not insert/update to cart_randa table" . $runsql;
  }
  mysqli_close($conn);

?>
