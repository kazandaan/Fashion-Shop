<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>RANDA</title>
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/utility.css">
  <link rel="stylesheet" href="css/carousel.css">
  <link rel="stylesheet" href="css/products.css">
  <link rel="stylesheet" href="css/loginmodal.css">
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
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

        $message = "";
        if( $page == "checkout" && $status == 2){ // status ?
          $message = "There are no items to checkout";
        }
        else if( $page == "cart" && $status == 0){ // fail checkout (no payment details)
          echo "openModal('paymentModal');";
        }
        // don't need ?
        else if( $page == "unauthorized" && $status == 2){
          $message = "Login to view page";
        }
        echo "setUpdateStatusDiv( ".$status.", '".$message."' );";
        echo "setTimeout(function(){location.replace(location.pathname)}, 2000);";
      }
      // SQL statements
      include "php/productPage.php";
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
    ?>

    <div id="products">
      <h1><?php echo ucfirst($title); ?></h1>
      <hr>

      <div class="flex">
        <!-- Left Side -->
        <div id="left">
          <form class="search-box" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <input id="searchbox" name="searchbox" type="search" placeholder="Search">
          </form>

          <!-- filtering -->
          <select id="priceRange" name="priceRange" onchange="checkPriceRange()">
            <option selected disabled style="display:none;">Price Range</option>
            <option value="0">$0 to $50</option>
            <option value="50">$50 to $100</option>
            <option value="100">$100+</option>
          </select>
          <?php
            $types = "SELECT DISTINCT product_type FROM product_randa";
            $runsql = mysqli_query($conn, $types);
            $type_array = array();
            while ($result = mysqli_fetch_assoc($runsql)) {
                array_push($type_array, $result['product_type']);
            }
          ?>
          <select id="type" name="type" onchange="checkType()">
            <option selected disabled style="display:none;">Type</option>
            <?php
              foreach( $type_array as $type ){
                echo "<option value='$type'>" . ucfirst($type) . "</option>";
              }
            ?>
          </select>
          <?php
            $brands = "SELECT DISTINCT product_brand FROM product_randa";
            $runsql = mysqli_query($conn, $brands);
            $brand_array = array();
            while ($result = mysqli_fetch_assoc($runsql)) {
                array_push($brand_array, $result['product_brand']);
            }
          ?>
          <select id="brand" name="brand" onchange="checkBrand()">
            <option selected disabled style="display:none;">Brand</option>
            <?php
              foreach( $brand_array as $brand ){
                echo "<option value='$brand'>" . ucfirst($brand) . "</option>";
              }
            ?>
          </select>

          <!-- Checkout Button -->
          <form id="checkoutBtn" action="checkout.php" method="POST" style="display:<?php echo $checkout; ?>;">
            <input type="submit" class="red_button" value="CHECKOUT"/>
          </form>
        </div>

        <section id="categories">
          <div>

            <?php
              // echo $sql . "<br>" . $_GET['page'];
              $runsql = mysqli_query($conn, $sql);
              if( !mysqli_num_rows($runsql) > 0 ){
                echo "<p style='margin-left:20px'>" . $msg . "</p>";
              }

              $closeddiv = false;
              $count = 0; // 3 per row
              while ($product = mysqli_fetch_assoc($runsql)) {
                $count++;
                if( $count % 3 == 1 ){ // first image of row
                  echo "<div class='flex text-mid productrow'>";
                  $closeddiv = false;
                }
            ?>
                <div class="frame">
                    <?php
                      // fav and cart icon
                      $iconid = $product['product_id'];
                      if( $_GET['page'] == "cart" ){
                        $iconid = $product['cart_id'];
                        if(checkCart($conn, $product['product_id'], $id)){
                          $removCartBtn = "block"; //only display in cart
                          $addCartBtn = "none";
                        }
                        else{
                          $removCartBtn = "none";
                          $addCartBtn = "block"; // default
                        }
                        $favBtn = "none";
                        $unfavBtn = "none";
                      }
                      else if( $_GET['page'] == "favourites" ){
                        if(checkFavourite($conn, $product['product_id'], $id)){
                          $favBtn = "block";
                          $unfavBtn = "none";
                        }
                        else{
                          $favBtn = "none";
                          $unfavBtn = "block"; //default
                        }
                        $removCartBtn = "none";
                        $addCartBtn = "block";
                      }
                      else{ // normal page (women, men, kids)
                        if(checkFavourite($conn, $product['product_id'], $id)){
                          $favBtn = "block";
                          $unfavBtn = "none";
                        }
                        else{
                          $favBtn = "none";
                          $unfavBtn = "block"; //default
                        }
                        $removCartBtn = "none";
                        $addCartBtn = "block";
                      }
                      ?>
                    <!-- fav and add to cart button -->
                    <div class="flex">
                      <span class="material-icons" id="unfavBtn<?php echo $iconid; ?>" style="display:<?php echo $unfavBtn; ?>;"><a onclick="favouriteProduct(<?php echo $iconid .',' . $product['product_id'] . ',' . $id; ?>)" title="favourite" style="color:red;">favorite_border</a></span>
                      <span class="material-icons" id="favBtn<?php echo $iconid; ?>"  style="display:<?php echo $favBtn; ?>;"><a onclick="unfavouriteProduct(<?php echo $iconid .','. $product['product_id'] . ',' . $id; ?>)" title="unfavourite" style="color:red;">favorite</a></span>
                      <span class="material-icons" id="addCartBtn<?php echo $iconid; ?>" style="display:<?php echo $addCartBtn; ?>;"><a onclick="addProduct(<?php echo $iconid .','. $id; ?>)" title="add to cart">add_shopping_cart</a></span>
                      <span class="material-icons" id="removeCartBtn<?php echo $iconid; ?>" style="display:<?php echo $removCartBtn; ?>;"><a onclick="removeProduct(<?php echo $iconid . ',' . $id; ?>)" title="remove from cart">remove_shopping_cart</a></span>
                    </div>
                    <?php
                      if( isset($_GET['page']) == "cart" ){
                        $cartparam = "page=cart&cartid=" . $product['cart_id']; //only display in cart
                      }
                      else{
                        $cartparam = "productid=" . $product['product_id'];
                      }
                    ?>

                    <a href="displayProduct.php?<?php echo $cartparam; ?>"> <!-- productid=<?php //echo $product['product_id']; ?> -->
                      <img src="image/<?php echo $product['product_img']; ?>" alt="<?php echo $product['product_name']; ?>" class="zoom img-fluid">
                      <div id="info">
                        <p><?php echo $product['product_name']; ?></p>
                        <?php
                          if($product['quantity'] != null && $product['size'] != null ){
                            $qty_str = $product['quantity'] . " x ";
                            $size_str = "[Size: " . $product['size'] . "]";
                          }
                        ?>
                        <p><?php echo $qty_str; ?> $<?php echo number_format((float)$product['product_price'], 2); ?><br><?php echo $size_str; ?></p>
                      </div>
                    </a>
                  </div>
            <?php
                if( $count % 3 == 0 ){ // last image of row
                  echo "</div>" . $closeddiv;
                  $closeddiv = true;
                }
            ?>

            <?php
              } // end of while loop

              if(!$closeddiv){ //if div was not closed
                echo "</div>";
              }

              function checkFavourite($conn, $productid, $userid ){
                $fav = false;
                if( isset($userid) ){ // user id set
                  $sql = "SELECT * FROM rating_randa WHERE product_id = $productid && user_id = $userid";
                  $runsql = mysqli_query($conn, $sql);
                  $rating = mysqli_fetch_assoc($runsql);
                  $fav = $rating['rating_favourite'];
                }
                return $fav;
              }

              function checkCart($conn, $productid, $userid){
                $inCart = false;
                if( isset($userid) ){ // user id set
                  $sql = "SELECT * FROM cart_randa WHERE product_id = $productid && user_id = $userid";
                  $runsql = mysqli_query($conn, $sql);
                  $cart = mysqli_fetch_assoc($runsql);
                  $inCart = mysqli_num_rows($cart) > 0;
                }
                return $cart;
              }
          ?>
            </div>
        </section>
      </div>
    </div> <!-- end of products div -->

  <!-- This generates modal -->
  <?php echo file_get_contents("html/modal.html"); ?>


  <?php
    mysqli_close($conn);
  ?>

  <!-- This generates footer -->
  <?php echo file_get_contents("html/bottom.html"); ?>

  <script type="text/javascript" src="js/modal.js"></script> <!-- Modal script -->
  <script type="text/javascript" src="js/products.js"></script>
  <script type="text/javascript" src="js/statusMessages.js"></script>
  <script type="text/javascript" src="js/banner&btoTop.js"></script> <!-- Banner & B to top button -->
</body>
</html>
