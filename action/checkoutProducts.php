<?php
/*
  INSERT into checkout_randa & checkoutDetails_randa
  THEN DELETE from cart_randa
*/

  // Create connection (servername, username, password, dbname)
  $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // Check if payment details are THERE yes>continue, no>go back

  //variables
  $userid = $_POST['userid'];
  $totalprice = $_POST['totalprice'];
  $date = date("Y-m-d") . "";
  $execute = 0;

  // set auto-increment for INSERT statements
  $ai = "ALTER TABLE checkout_randa AUTO_INCREMENT = 1";
  $run = mysqli_query($conn, $ai);

  // INSERT into checkout_randa
  $sql = "INSERT INTO checkout_randa (user_id, total_price, checkout_date)
  VALUES ($userid, $totalprice, '$date')";

  echo $sql . "<br>";

  if (mysqli_query($conn, $sql)) {
    // get checkoutid
    $sql = "SELECT * FROM checkout_randa ORDER BY checkout_id DESC LIMIT 1";
    $runsql = mysqli_query($conn, $sql);
    $checkout = mysqli_fetch_assoc($runsql);
    $checkoutid = $checkout['checkout_id'];
    $success = true;
    echo "inserted into checkout_randa: $sql : $checkoutid<br>";
    insertDetails($conn, $checkoutid, $userid, $date);
  }
  else {
    echo "Failed to insert in checkout_randa<br>";
    $success = false;
  }

  function insertDetails($conn, $checkoutid, $userid, $date){

    // GET product_id, price, quantity from cart_randa > INSERT into checkoutDetails_randa
    $sql = "SELECT * FROM cart_randa JOIN product_randa ON cart_randa.product_id = product_randa.product_id WHERE user_id = $userid ";
    $runsql = mysqli_query($conn, $sql);
    while($product= mysqli_fetch_assoc($runsql)){
      $productid = $product['product_id'];
      $productprice = $product['product_price'];
      $quantity = $product['quantity'];
      $size = $product['size'];

      // INSERT into checkout_randa
      $sql = "INSERT INTO checkoutDetails_randa (checkout_id, user_id, product_id, price, quantity, size, checkoutDetails_date)
      VALUES ($checkoutid, $userid, $productid, $productprice, $quantity, '$size', '$date')";

      if (mysqli_query($conn, $sql)) {
        // DELETE from cart_randa
        $success = true;
        echo "inserted into checkoutDetails_randa $productid<br>";
      }
      else{
        echo "Failed to insert in checkoutDetails_randa: $sql<br>";
        $success = false;
      }
    }
    if($success){
      deleteCart($conn, $userid);
    }
  }

  function deleteCart($conn, $userid){
    $sql = "DELETE FROM cart_randa WHERE user_id = $userid";
    $runsql = mysqli_query($conn, $sql);

    if (mysqli_query($conn, $sql)) {
      $success = true;
      echo "deleted cart_randa<br> $success";
    }
    else{
      echo "Failed to delete cart_randa<br> $success";
      $success = false;
    }
  }

  if($success == 1){
    // send email
    $sql = "SELECT * FROM user_randa WHERE user_id = $userid";
    $runsql = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($runsql);

    $subject = "Checkout Confirmed";
    $message = "To: " . $user['user_email'] . "\nSuccessful Checkout";
    include "../php/mail.php";

    header("Location:../orders.php?checkoutid=$checkoutid&page=checkout&status=$success");
  }
  else{
    header("Location:../products.php?page=cart&status=$success");
  }

  mysqli_close($conn);

?>
