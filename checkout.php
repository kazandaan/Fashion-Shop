<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>RANDA</title>
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/utility.css">
  <link rel="stylesheet" href="css/carousel.css">
  <link rel="stylesheet" href="css/checkout.css">
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="apple-touch-icon" sizes="180x180" href="image/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="image/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="image/favicon-16x16.png">
</head>

<!-- Check Session -->
<?php
  session_start();
  if(!isset($_SESSION['userid'])){
    header("Location:index.php?page=unauthorized&status=2");
  }
  else{
    $id = $_SESSION['userid'];
    $username = $_SESSION['username'];
    $dropdown = "none";
    $logout = "block";
  }
?>
<body>

  <!-- This generates nav and banner -->
  <?php include "html/top.php"; ?>

  <?php
    // Create connection (servername, username, password, dbname)
    $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
  ?>

  <!-- START SCRIPT | Window ONLOAD, $_GET Stuff -->
  <script>
    window.onload = function(){
  <?php

    // Check user's payment details
    $sql = "SELECT * FROM user_randa WHERE user_id = $id";
    $runsql = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($runsql);
    if($user['user_cardno'] == "" && $user['user_cardname'] == "" && $user['user_card'] == "" ){
      header("Location:" . $_SERVER['HTTP_REFERER']); // popup > key in payment details OR go account and update ?
    }

    }
  ?>
    } // end of window.onload = function()
  </script>
  <!-- END SCRIPT | Window ONLOAD, $_GET Stuff -->

  <section id="checkout">
    <h1>Checkout Items</h1>
    <hr>

    <div class="container-fluid">
      <form id="checkoutBtn" class="buttons" action="action/checkoutProducts.php" method="POST">
        <table>
          <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Price</th>
            <th></th>
          </tr>
          <?php
            $sql = "SELECT * FROM product_randa
            JOIN cart_randa ON product_randa.product_id = cart_randa.product_id
            WHERE user_id = $id";
            $runsql = mysqli_query($conn, $sql);
            // should not be empty
            if( !mysqli_num_rows($runsql) > 0 ){
              header("Location:products.php?page=checkout&status=2");
            }

            $sn = 0;
            $totalPrice = 0;
            while ($product = mysqli_fetch_assoc($runsql)) {
              $sn++;
              $price2dp = number_format((float)$product['product_price'], 2);
              $total = (float) $product['product_price'] * $product['quantity'];
              $totalPrice += $total;
          ?>
          <tr>
            <td><?php echo $sn; ?></td>
            <td><?php echo $product['product_name']; ?></td>
            <td><?php echo $product['size']; ?></td>
            <td>$<?php echo $price2dp . " x " . $product['quantity']; ?></td>
            <td>$<?php echo number_format($total, 2); ?></td>
            <td><span class="material-icons" id="bin<?php echo $product['cart_id']; ?>"><a onclick="removeProduct(<?php echo $product['cart_id'] . ',' . $id; ?>)" title="delete order">delete_forever</a></span></td>
          </tr>
          <?php
            }
          ?>
          <tr>
            <th colspan="4" style="text-align:right;">Total</th>
            <th>$<?php echo number_format($totalPrice, 2); ?></th>
            <th></th>
          </tr>
          <tr>
            <td class="last" colspan="5">
              <!-- Hidden values -->
              <input type="hidden" name="userid" value="<?php echo $id; ?>"/>
              <input type="hidden" name="totalprice" value="<?php echo $totalPrice; ?>"/>
              <!-- Checkout Button -->
              <input type="submit" class="red_button" value="CONFIRM CHECKOUT"/>
            </td>
          </tr>
          <tr>
            <td class="last" colspan="5">Date: <?php echo date("d-m-Y"); ?></td>
          </tr>
        </table>
      </form>
    </div>
  </section>

  <?php
    mysqli_close($conn);
  ?>

  <script>
  // For the delete icon
  function removeProduct(cartid){
    var bin = document.getElementById('bin' + cartid);
    location.replace("action/cartProduct.php?action=delete&cartid=" + cartid );
  }

  </script>

  <!-- This generates footer -->
  <?php echo file_get_contents("html/bottom.html"); ?>
</body>
