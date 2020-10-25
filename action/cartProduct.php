<?php

  // Create connection (servername, username, password, dbname)
  $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  //variables
  $action = $_GET['action']; // insert or update or delete
  if( isset($_GET['userid']) ){
    $userid = $_GET['userid'];
  }
  else if( isset($_POST['userid']) ){
    $userid = $_POST['userid'];
  }

  if( isset($_GET['productid']) ){ $productid = $_GET['productid']; }
  else if( isset($_POST['productid']) ){ $productid = $_POST['productid']; }

  if( isset($_POST['quantity']) ){
    $quantity = $_POST['quantity'];
  }

  if( isset($_POST['size']) ){
    $size = $_POST['size'];
  }

  if($userid == ""){
    if($_SERVER['HTTP_REFERER'] == "http://192.168.56.2/f32ee/Fashion-Shop/displayProduct.php?productid=" . $productid){
      $url = $_SERVER['HTTP_REFERER'] . "&status=2";
    }
    else{
      $url = $_SERVER['HTTP_REFERER'];
    }
    header("Location:" .  $url);
  }

  // $userid = $_GET['userid'];
  // $productid = $_GET['productid'];
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
      $sql = "UPDATE cart_randa SET quantity = $quantity, size = '$size' WHERE user_id = $userid AND product_id = $productid";
      $runsql = mysqli_query($conn, $sql);
    }
    else if($action == "delete"){
      $sql = "DELETE FROM cart_randa WHERE user_id = $userid AND product_id = $productid";
      $runsql = mysqli_query($conn, $sql);
    }
  }
  else{ // INSERT
    if($action == "update"){ //the button
      $sql = "INSERT INTO cart_randa (user_id, product_id, quantity, size) VALUES ($userid, $productid, $quantity, '$size')";
      echo $sql;
    }
    else{
      $sql = "INSERT INTO cart_randa (user_id, product_id) VALUES ($userid, $productid)";
    }
    $runsql = mysqli_query($conn, $sql);
  }

  if($runsql){
    $execute = 1;

    if($_SERVER['HTTP_REFERER'] == "http://192.168.56.2/f32ee/Fashion-Shop/displayProduct.php?productid=" . $productid){
      $url = $_SERVER['HTTP_REFERER'] . "&status=$execute";
    }
    else{
      $url = $_SERVER['HTTP_REFERER'];
    }
    header("Location:" .  $url);
    // header("Location:" .  $_SERVER['HTTP_REFERER'] );
  }
  else{
    echo "could not insert/update to cart_randa table" . $runsql;
  }
  mysqli_close($conn);

?>
