<?php

  // Create connection (servername, username, password, dbname)
  $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  //variables
  $action = $_GET['action']; //insert/update or delete
  $userid = $_GET['userid'];
  $productid = $_GET['productid'];
  $quantity = $_GET['quantity'];
  $execute = 0;

  // set auto-increment for INSERT statements
  $ai = "ALTER TABLE user_randa AUTO_INCREMENT = 1";
  $run = mysqli_query($conn, $ai);

  // check if userid and productid is in the table
  $sql = "SELECT * FROM cart_randa WHERE user_id = $userid AND product_id = $productid";
  $runsql = mysqli_query($conn, $sql);

  if( mysqli_num_rows($runsql) > 0 ){ // UPDATE or DELETE
    $rating = mysqli_fetch_assoc($runsql);
    if($action == "update"){
      $sql = "UPDATE cart_randa SET quantity = $quantity WHERE user_id = $userid AND product_id = $productid";
      $runsql = mysqli_query($conn, $sql);
    }
    else if($action == "delete"){
      $sql = "DELETE FROM cart_randa WHERE user_id = $userid AND product_id = $productid";
      $runsql = mysqli_query($conn, $sql);
    }
  }
  else{ // INSERT
    $sql = "INSERT INTO cart_randa (user_id, product_id, quantity)
    VALUES ($userid, $productid, $quantity)";
    $runsql = mysqli_query($conn, $sql);
  }

  if($runsql){
    $execute = 1;
    header("Location:" .  $_SERVER['HTTP_REFERER']);
  }
  else{
    echo "could not insert/update to rating_randa table" . $runsql;
  }
  mysqli_close($conn);

?>
