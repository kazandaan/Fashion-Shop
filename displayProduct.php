<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>RANDA</title>
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/utility.css">
  <link rel="stylesheet" href="css/carousel.css">
  <link rel="stylesheet" href="css/displayProduct.css">
  <link rel="stylesheet" href="css/imageModal.css">
  <link rel="stylesheet" href="css/loginmodal.css">
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
    $username = "My Account";
    $dropdown = "block";
    $logout = "none";
  }
  else{
    $id = $_SESSION['userid'];
    $username = $_SESSION['username'];
    $dropdown = "none";
    $logout = "block";
  }

?>
<body>
  <?php include "html/top.php";?>

  <!-- START SCRIPT | Window ONLOAD, $_GET Stuff -->
    <script type="text/javascript" src="js/statusMessages.js"></script>
    <script>
      window.onload = function(){
    <?php

      if(isset($_GET['productid']) || isset($_GET['cartid'])){
        $productid = $_GET['productid'];
        $cartid = $_GET['cartid'];
      }
      else{
        echo "window.history.back();";
      }

      if( isset($_GET['productid']) && isset($_GET['status'])){
        $productid = (int)$_GET['productid'];
        $status = $_GET['status'];

        $message = "";
        if( $productid > 0 && $status == 0){
          $message = "Failed to add to cart";
        }
        else if( $productid > 0 && $status == 1){
          $message = "Added to Cart";
        }
        else if( $productid > 0 && $status == 2){
          $message = "Login to add product";
        }
        echo "setUpdateStatusDiv( ".$status.", '".$message."' );";
        // echo "setTimeout(function(){location.replace(location.pathname)}, 1000);";
      }

      if( isset($_GET['cartid']) && isset($_GET['status'])){
        $cartid = (int)$_GET['cartid'];
        $status = $_GET['status'];
        if( $cartid > 0 && $status == 1){
          $message = "Cart Updated"; //update
        }
        echo "setUpdateStatusDiv( ".$status.", '".$message."' );";
      }
      // SQL statements
      include "php/productPage.php";
    ?>
      } // end of window.onload = function()
    </script>
    <!-- END SCRIPT | Window ONLOAD, $_GET Stuff -->

  <section id="displayproduct">
    <div class="container-fluid">
      <div class="row img-wrapper" style="align-items:center;">

        <?php
          // Create connection (servername, username, password, dbname)
          $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

          // Check connection
          if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
          }

          $productid = $_GET['productid'];

          if($_GET['page'] == "cart"){ // from cart > displayProduct
            $sql = "SELECT * FROM cart_randa JOIN product_randa ON cart_randa.product_id = product_randa.product_id
            WHERE user_id = $id AND cart_id = $cartid";
            $runsql = mysqli_query($conn, $sql);
            $product = mysqli_fetch_assoc($runsql);

            $val = "UPDATE";
            $action = "update";
          }
          else{ // from normal > displayProduct
            $sql = "SELECT * FROM product_randa WHERE product_id = $productid";
            $runsql = mysqli_query($conn, $sql);
            $product = mysqli_fetch_assoc($runsql);

            $val = "ADD TO CART";
            $action = "insert";
          }
        ?>

        <div class="col text-mid ">
            <img id="myImg" class="img-fluid zoom" src="image/<?php echo $product['product_img']; ?>" alt="<?php echo $product['product_name']; ?>">
        </div>
        <div class="col">
          <form class="" action="action/cartProduct.php?action=<?php echo $action; ?>" method="post">
            <div class="product_name attribute">
              <h2><?php echo $product['product_name']; ?></h2>
            </div>
            <div class="product_descrption attribute">
              <p><?php echo $product['product_brand']; ?>: <?php echo $product['product_type']; ?><br><?php echo $product['product_desc']; ?></p>
            </div>
            <div class="price_tag attribute">
              <strong>$<?php echo number_format($product['product_price'],2); ?></strong>
            </div>
            <!-- Hidden values -->
            <input type="hidden" name="userid" value="<?php echo $id; ?>">
            <input type="hidden" name="productid" value="<?php echo $product['product_id']; ?>">
            <input type="hidden" name="cartid" value="<?php echo $product['cart_id']; ?>">

            <!-- display db results, javascript below -->
            <div class="size_selection attribute">
              <p>Please select your size:</p>
              <div class="flex" style="align-items:center;">
                <input type="radio" id="XS" name="size" value="XS" required>
                <label for="">XS</label><br>
                <input type="radio" id="S" name="size" value="S">
                <label for="">S</label><br>
                <input type="radio" id="M" name="size" value="M">
                <label for="">M</label><br>
                <input type="radio" id="L" name="size" value="L">
                <label for="">L</label><br>
              </div>
            </div>
            <div class="quantity attribute">
              <label for="">Quantity:</label><br>
              <input type="number" name="quantity" id="quantity" value="1" step="1" min="1" max="99">
            </div>

            <div class="flex attribute">
              <input class="form-control btnAdd2cart" type="submit" name="add2cart" id="add2cart" value="<?php echo $val; ?>" >
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php echo file_get_contents ("html/imageModal.html"); ?>
  </section>

  <script>
    // set size and quantity from db
    var radio = document.getElementById("<?php echo $product['size']; ?>");
    radio.checked = true;

    var qty = document.getElementById("quantity");
    qty.value = <?php echo $product['quantity']; ?>;
  </script>

  <?php
  mysqli_close($conn);
  ?>

  <!-- Popup Block -->
  <div class="messagePopup" id="updateStatus">
    <h2 id="messageHeader"></h2>
  </div>

  <!-- This generates modal -->
  <?php echo file_get_contents("html/modal.html"); ?>

  <!-- This generates footer -->
  <?php echo file_get_contents("html/bottom.html"); ?>

  <script type="text/javascript" src="js/imageModal.js"></script> <!-- Product Image Modal script -->
  <script type="text/javascript" src="js/modal.js"></script> <!-- Modal script -->
  <script type="text/javascript" src="js/banner&btoTop.js"></script> <!-- Banner & B to top button -->
</body>
