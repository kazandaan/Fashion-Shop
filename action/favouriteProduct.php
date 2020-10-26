<?php

  // Create connection (servername, username, password, dbname)
  $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  //variables
  $userid = $_GET['userid'];
  $productid = $_GET['productid'];
  $like= $_GET['like'];
  $action = 0;

  // set auto-increment for INSERT statements
  $ai = "ALTER TABLE rating_randa AUTO_INCREMENT = 1";
  $run = mysqli_query($conn, $ai);

  // check if userid and productid is in the table
  $sql = "SELECT * FROM rating_randa WHERE user_id = $userid AND product_id = $productid";
  $runsql = mysqli_query($conn, $sql);

  if( mysqli_num_rows($runsql) > 0 ){ // UPDATE
    $rating = mysqli_fetch_assoc($runsql);
    $sql = "UPDATE rating_randa SET rating_favourite = $like WHERE user_id = $userid AND product_id = $productid";
    $runsql = mysqli_query($conn, $sql);
  }
  else{ // INSERT
    $sql = "INSERT INTO rating_randa (user_id, product_id, rating_favourite)
    VALUES ($userid, $productid, $like)";
    $runsql = mysqli_query($conn, $sql);
  }

  if($runsql){
    $action = 1;
    header("Location:" .  $_SERVER['HTTP_REFERER']);
  }
  else{
    echo "could not insert/update to rating_randa table" . $runsql;
  }
  mysqli_close($conn);

?>
