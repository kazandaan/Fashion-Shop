<!--
Orders Page
Display Orders made by the user
User can Display Order Details of selected Order, Cancel Orders
-->

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>RANDA</title>
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/utility.css">
  <link rel="stylesheet" href="css/carousel.css">
  <link rel="stylesheet" href="css/orders.css">
  <link rel="stylesheet" href="css/loginmodal.css">
  <link rel="stylesheet" href="css/responsive.css"><link rel="stylesheet" href="css/responsive.css">
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

  if(isset($_GET['checkoutid']) ){
    $checkoutid = $_GET['checkoutid'];
  }
?>
<body>

  <!-- This generates nav and banner -->
  <?php include "html/top.php"; ?>

  <!-- START SCRIPT | Window ONLOAD, $_GET Stuff -->
  <script type="text/javascript" src="js/statusMessages.js"></script>
  <script>
    window.onload = function(){
  <?php

    if( isset($_GET['page']) && isset($_GET['status'])){
      $page = $_GET['page'];
      $status = $_GET['status'];

      if( $page == "checkout" && $status == 1){
        // set url without query string
        echo "window.history.pushState('object', document.title, 'orders.php?checkoutid=" . $checkoutid ."');";
        echo "openModal('checkoutSuccessModal');";
      }
    }
  ?>
    } // end of window.onload = function()
  </script>
  <!-- END SCRIPT | Window ONLOAD, $_GET Stuff -->

  <?php
    // Create connection (servername, username, password, dbname)
    $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM checkout_randa WHERE checkout_id = $checkoutid";
    $runsql = mysqli_query($conn, $sql);
    if(!mysqli_num_rows($runsql) > 0 ){
      $noOrder = true;
    }
    $result = mysqli_fetch_assoc($runsql);
    $date = date_create($result['checkout_date']);

    if($noOrder){
      $display = "none";
    }
    else{
      $display = "block";
    }
  ?>

  <section id="orders">
    <h1>Your Order</h1>
    <hr>

    <div class="container-fluid">

      <div style="display:<?php echo $display; ?>;">
        <table >
          <tr>
            <th colspan="2" align="left">Order ID: <?php echo $checkoutid; ?></th>
            <th colspan="2" align="right">Date: <?php echo date_format($date, "d-m-Y" ); ?></th>
          </tr>
          <?php
            $productsql = "SELECT DISTINCT product_id FROM checkoutDetails_randa WHERE checkout_id = $checkoutid";
            $runsql = mysqli_query($conn, $productsql);
            $product_array = array();
            while ($result = mysqli_fetch_assoc($runsql)) {
                array_push($product_array, $result['product_id']);
            }
            $size_array = array('XS', 'S', 'M', 'L');

            $sn = 0;
            $finalTotal = 0;
            foreach($product_array as $productid){

              $sql = "SELECT * FROM product_randa WHERE product_id = $productid";
              $runsql = mysqli_query($conn, $sql);

              while ($product = mysqli_fetch_assoc($runsql)) {
                // sn, img, name, brand + type
                $sn++;
          ?>
          <tr>
            <th><?php echo $sn; ?>. </th>
            <th colspan="3" align="left"><?php echo $product['product_name']; ?></th>
          </tr>
          <tr>
            <td rowspan="8"></td>
            <td rowspan="8" align="center"><img src="image/<?php echo $product['product_img']; ?>" alt="<?php echo $product['product_name']; ?>"></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo 'Brand: ',$product['product_brand']; ?> (<?php echo $product['product_type']; ?>)</td>
          </tr>
          <tr>
            <td align="center"><b>Size</b></td>
            <td align="center"><b>Qty</b></td>
          </tr>

              <?php
                $empty_array = array(); // size not bought
                foreach($size_array as $size){
                  $sql = "SELECT * FROM checkoutDetails_randa
                  JOIN product_randa ON checkoutDetails_randa.product_id = product_randa.product_id
                  WHERE size LIKE '$size' AND checkoutDetails_randa.product_id = $productid AND checkout_id = $checkoutid";
                  $runsql = mysqli_query($conn, $sql);

                  if( !mysqli_num_rows($runsql)>0 ){
                    array_push( $empty_array, "empty");
                  }
                  else{

                    $totalPrice = 0;
                    while ($order = mysqli_fetch_assoc($runsql)) {
                      $price2dp = number_format((float)$order['product_price'], 2);
                      $total = (float) $order['product_price'] * $order['quantity'];
                      $totalPrice += $total;

              ?>
              <tr>
                <td align="center"><?php echo $order['size']; ?></td>
                <td align="center"><?php echo $order['quantity']; ?></td>
              </tr>

              <?php
                    }// end of while loop
                  } // end of else
                }// end of $size_array foreach loop
                foreach($empty_array as $empty){
                  echo "<tr><td style='color:white;'>.</td><td></td></tr>";
                }
              ?>

          <tr>
            <td colspan="2">$<?php echo number_format($totalPrice, 2); ?> ($<?php echo $price2dp; ?> each)</td>
          </tr>
          <tr><td id="divider" colspan="4"></td></tr>
          <?php
            $finalTotal += $totalPrice;
          }
        } // end of product_array foreach loop
          ?>
          <tr>
            <td colspan="4" align="center" style="font-size:30px;"><b>Total Price: </b>$<?php echo number_format($finalTotal, 2); ?></td>
          </tr>
        </table>
      </div>

      <div class="flex">
        <input type="button" class="red_button" onclick="openModal('ordersModal')" value="VIEW ORDERS"/>
        <input type="button" class="red_button" onclick="clearOrder('<?php echo $checkoutid; ?>')" value="CANCEL ORDER" style="display:<?php echo $display; ?>;"/>
      </div>
    </div>
  </section>

  <!-- Checkout Success Modal -->
  <div id="checkoutSuccessModal" class="modal">
    <div class="modal-content2">
      <span class="close2" onclick="closeModal('checkoutSuccessModal')">&times;</span>
        <h2>Checkout Successful</h2>
        <?php
          $sql = "SELECT * FROM user_randa WHERE user_id = $id";
          $runsql = mysqli_query($conn, $sql);
          $user = mysqli_fetch_assoc($runsql);
          $text = "An email has been sent to " . $user['user_email'];
          echo "<p>$text</p>";
        ?>
    </div>
  </div>
  <!-- End Checkout Success Modal -->

  <!-- View Orders Modal -->
  <div id="ordersModal" class="modal">
    <div class="modal-content2">
      <span class="close2" onclick="closeModal('ordersModal')">&times;</span>
        <h2>Your Orders</h2>
        <?php
          $sql = "SELECT * FROM checkout_randa WHERE user_id = $id";
          $runsql = mysqli_query($conn, $sql);
          if(!mysqli_num_rows($runsql) > 0 ){
            echo "<p>You have no Orders</p>";
          }
          while($result = mysqli_fetch_assoc($runsql)){
            $cid = $result['checkout_id'];
            $date = date_create($result['checkout_date']);
            $price2dp = number_format((float)$result['total_price'], 2);
            echo "<a onclick='viewOrder($cid)'><p>Order ID: ".$cid." on ". date_format($date, "d-m-Y" ) . " Total Price: $".$price2dp ."</p></a>";
          }
        ?>
    </div>
  </div>
  <!-- End View Orders Modal -->

  <?php
    mysqli_close($conn);
  ?>
  <script>
  function viewOrder(checkoutid){
    location.replace("orders.php?checkoutid=" + checkoutid );
  }
  function clearOrder(checkoutid){
    location.replace("action/clearOrder.php?checkoutid=" + checkoutid );
  }
  function setURL(){
    setTimeout(function(){window.history.replaceState('object', document.title, "index.php");}, 2000);
  }

  </script>
  <script type="text/javascript" src="js/modal.js"></script> <!-- Modal script -->
  <script type="text/javascript" src="js/sidebar.js"></script>
  <!-- This generates footer -->
  <?php echo file_get_contents("html/bottom.html"); ?>
</body>
