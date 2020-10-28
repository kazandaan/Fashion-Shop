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
  // if($userid == ""){
  //   if($_SERVER['HTTP_REFERER'] == "http://192.168.56.2/f32ee/Fashion-Shop/displayProduct.php?productid=" . $productid){
  //     $url = $_SERVER['HTTP_REFERER'] . "&status=2";
  //   }
  //   else{
  //     $url = $_SERVER['HTTP_REFERER'];
  //   }
  //   header("Location:" .  $url);
  // }

  $sql = "DELETE FROM checkoutDetails_randa WHERE checkout_id = $checkoutid";
  if(mysqli_query($conn, $sql)){
    $sql = "DELETE FROM checkout_randa WHERE checkout_id = $checkoutid";
    $execute = mysqli_query($conn, $sql);
  }

  if($execute){

// change
    if($_SERVER['HTTP_REFERER'] == "http://192.168.56.2/f32ee/Fashion-Shop/displayProduct.php?productid=" . $productid
    || $_SERVER['HTTP_REFERER'] == "http://192.168.56.2/f32ee/Fashion-Shop/displayProduct.php?page=cart&cartid=" . $cartid ){
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
