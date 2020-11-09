<?php
/*
  INSERT to Cart based on user's id
  UPDATE and DELETE from Cart based on cart's id
*/

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

  if( isset($_POST['quantity']) && isset($_POST['size']) ){
    $quantity = $_POST['quantity'];
    $size = $_POST['size'];
  }
  else{
    $quantity = 1;
    $size = 'S';
  }

  if( isset($_GET['cartid']) ){
    $cartid = $_GET['cartid'];
  }
  else if( isset($_POST['cartid']) ){
    $cartid = $_POST['cartid'];
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

  $execute = 0;

  // set auto-increment for INSERT statements
  $ai = "ALTER TABLE cart_randa AUTO_INCREMENT = 1";
  $run = mysqli_query($conn, $ai);

  if($action == "insert"){
    $sql = "SELECT * FROM cart_randa WHERE size LIKE '$size' AND product_id = $productid AND user_id = $userid";
    $runsql = mysqli_query($conn, $sql);
    if(mysqli_num_rows($runsql) > 0){
      $cart = mysqli_fetch_assoc($runsql);
      $cartid = $cart['cart_id'];
      $quantity += $cart['quantity'];
      $sql = "UPDATE cart_randa SET quantity = $quantity WHERE size LIKE '$size' AND product_id = $productid AND user_id = $userid";
    }
    else{
      $sql = "INSERT INTO cart_randa (user_id, product_id, quantity, size) VALUES ($userid, $productid, $quantity, '$size')";

    }
    $runsql = mysqli_query($conn, $sql);
  }
  else if($action == "update"){
    $sql = "UPDATE cart_randa SET quantity = $quantity, size = '$size' WHERE cart_id = $cartid";
    echo $sql;
    $runsql = mysqli_query($conn, $sql);
  }
  else if($action == "delete"){
    $sql = "DELETE FROM cart_randa WHERE cart_id = $cartid";
    $runsql = mysqli_query($conn, $sql);
  }

  if($runsql){
    $execute = 3;

    if( strpos($_SERVER['HTTP_REFERER'], "displayProduct") !== false ){
      $url = $_SERVER['HTTP_REFERER'] . "&status=$execute";
    }
    else{
      $url = $_SERVER['HTTP_REFERER'];
    }
    header("Location:" .  $url);
  }
  else{
    echo "could not insert/update to cart_randa table" . $runsql;
  }
  mysqli_close($conn);

?>
