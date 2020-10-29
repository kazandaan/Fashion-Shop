<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>RANDA</title>
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/utility.css">
  <link rel="stylesheet" href="css/carousel.css">
  <link rel="stylesheet" href="css/loginmodal.css">
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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

  /**
   * Connect DB
   */
  $servername = "localhost";
  $username2 = "f32ee";
  $password = "f32ee";
  $database = "f32ee";

  // Create connection
 $conn = new mysqli($servername, $username2, $password, $database);

 // Check connection
 if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
 }

 $price = $conn->query("SELECT FORMAT(product_price, 2) AS product_price from product_randa");
 $name =  $conn->query("SELECT product_name from product_randa");

 $storeArray = Array();
 $storeArray2 = Array();

 if (!$price) {
   trigger_error('Invalid query: ' . $conn->error);
 }

 if (!$name) {
   trigger_error('Invalid query: ' . $conn->error);
 }


 while ($row = $price->fetch_assoc()){
         $storeArray2[] =  $row['product_price'];
         //Fetch all the price into array
       }

 while ($row = $name->fetch_assoc()){
         $storeArray[] =  $row['product_name'];
         //Fetch all the price into array
       }
?>

<body>
   <?php include "html/top.php" ?>


  <!-- START SCRIPT | Window ONLOAD, $_GET Stuff -->
    <script>
      window.onload = function(){
        <?php
          if( isset($_GET['page']) && isset($_GET['status'])){
            $page = $_GET['page'];
            $status = $_GET['status'];

            $message = "";
            // loginUser > 1 > account.php
            if( $page == "loginUser" && $status == 1){
              $message = "Welcome back, $username!";
            }
            else if( $page == "loginUser" && $status == 0){
              $message = "Username or password is incorrect. ";
            }
            else if( $page == "registerUser" && $status == 3){
              $message = "Successfully Registered";
            }
            else if( $page == "registerUser" && $status == 0){
              $message = "Failed to Register";
            }
            else if( $page == "unauthorized" && $status == 2){
              $message = "Login to view page";
            }
            echo "setUpdateStatusDiv( ".$status.", '".$message."' )";
          }
        ?>
      } // end of window.onload = function()
  </script>
  <!-- END SCRIPT | Window ONLOAD, $_GET Stuff -->

  <section id="carousel">
    <div class="slideshow-container ">
      <div class="container-fluid">
        <div class="mySlides fade">
          <div class="row">
            <div class="col">
              <img src="image/model.png" class="img-fluid">
            </div>
            <div class="col">
              <div class="slide_description1 text-mid" style="margin-top: 30%;">
                <h3>#GRAB US NOW</h3>
                <h2 style="font-size: 50px; font-weight:500;">GET UP TO 30% NEW ARRIVAL</h2>
                <a href="products.php" class="shop_button red_button frame">SHOP NOW</a>
              </div>
            </div>
          </div>
        </div>

        <div class="mySlides fade">
          <div class="row">

            <div class="col">
              <div class="slide_description2 text-mid"  style="margin-top: 30%;">
                <h3>#FASHION KIDS</h3>
                <h2 style="font-size: 50px; font-weight:500;">DRESS YOUR CHILD</h2>
                <a href="products.php?category=kids" class="shop_button red_button frame">SHOP NOW</a>
              </div>
            </div>
            <div class="col">
              <img src="image/child_model.png" class="img-fluid">
            </div>
          </div>
        </div>

        <div class="mySlides fade">
          <div class="row">
            <div class="col" style="position:relative;">
              <img src="image/guy_model.png" class="img-fluid">
              <div class="slide_description3 text-mid" style="position:absolute; top:20%; left:60%;">
                <h3>#OPPA</h3>
                <h2 style="font-size: 50px; font-weight:500;">BE A HOT GUY.</h2>
                <a href="products.php?category=men"  class="shop_button red_button frame">SHOP NOW</a>
              </div>
            </div>
          </div>
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>


      </div>
    </div>
  </section>
  <section id="categories">

      <div class="row flex text-mid">

        <div class="col zoom banner-item" style="background-image:url(image/woman_banner.jpg)">
            <div class="banner-category">
              <a href="products.php?category=women">WOMEN'S</a>
            </div>
        </div>
        <div class="col zoom banner-item" style="background-image:url(image/girl_banner.jpg)">
          <div class="banner-category">
              <a href="products.php?category=kids">KIDS'</a>
          </div>
        </div>
        <div class="col zoom banner-item" style="background-image:url(image/man_banner.jpg)">
            <div class="banner-category">
                <a href="products.php?category=men">MEN'S</a>
            </div>
        </div>
      </div>
  </section>
  <section id="new-arrival">
    <div class="container-fluid">
      <div class="title-section">
        <h2>New Arrival</h2>
      </div>
      <div class="row text-mid">
        <div class="col">
          <a href="displayProduct.php?productid=3" class="product-item zoom">
            <img class="img-fluid" src="image/<?php echo 'women/3.jpg'?>" alt=""></a>
          <h3 class="item-title"><?php echo $storeArray[2] ?></h3>
          <strong>$<?php echo $storeArray2[2] ?></strong>
        </div>
        <div class="col">
          <a href="displayProduct.php?productid=12" class="product-item zoom">
            <img class="img-fluid" src="image/<?php echo 'kids/2.jpg'?>" alt=""></a>
          <h3 class="item-title"><?php echo $storeArray[11] ?></h3>
          <strong>$<?php echo $storeArray2[11] ?></strong>
        </div>
        <div class="col">
          <a href="displayProduct.php?productid=8" class="product-item zoom">
            <img class="img-fluid" src="image/<?php echo 'men/3.jpg'?>" alt=""></a>
          <h3 class="item-title"><?php echo $storeArray[7] ?></h3>
          <strong>$<?php echo $storeArray2[7] ?></strong>
        </div>
      </div>

    </div>

  </section>
  <section id="popular">
    <div class="container-fluid">
      <div class="title-section text-mid">
        <h2>Popular Products</h2>
      </div>

      <div class="row text-mid">
        <div class="col">
          <a href="displayProduct.php?productid=1" class="product-item zoom">
            <img class="img-fluid" src="image/<?php echo 'women/1.jpg'?>" alt=""></a>
          <h3 class="item-title"><?php echo $storeArray[0] ?></h3>
          <strong>$<?php echo $storeArray2[0] ?></strong>
        </div>
        <div class="col">
          <a href="displayProduct.php?productid=11" class="product-item zoom">
            <img class="img-fluid" src="image/<?php echo 'kids/1.jpg'?>" alt=""></a>
          <h3 class="item-title"><?php echo $storeArray[10] ?></h3>
          <strong>$<?php echo $storeArray2[10] ?></strong>
        </div>
        <div class="col">
          <a href="displayProduct.php?productid=6" class="product-item zoom">
            <img class="img-fluid" src="image/<?php echo 'men/1.jpg'?>" alt=""></a>
          <h3 class="item-title"><?php echo $storeArray[5] ?></h3>
          <strong>$<?php echo $storeArray2[5] ?></strong>
        </div>
      </div>
      <div class="row text-mid">
        <div class="col">
          <a href="displayProduct.php?productid=4" class="product-item zoom">
            <img class="img-fluid" src="image/<?php echo 'women/4.jpg'?>" alt=""></a>
          <h3 class="item-title"><?php echo $storeArray[3] ?></h3>
          <strong>$<?php echo $storeArray2[3] ?></strong>
        </div>
        <div class="col">
          <a href="displayProduct.php?productid=7" class="product-item zoom">
            <img class="img-fluid" src="image/<?php echo 'men/2.jpg'?>" alt=""></a>
          <h3 class="item-title"><?php echo $storeArray[6] ?></h3>
          <strong>$<?php echo $storeArray2[6] ?></strong>
        </div>
        <div class="col">
          <a href="displayProduct.php?productid=15" class="product-item zoom">
            <img class="img-fluid" src="image/<?php echo 'kids/5.jpg'?>" alt=""></a>
          <h3 class="item-title"><?php echo $storeArray[14] ?></h3>
          <strong>$<?php echo $storeArray2[14] ?></strong>
        </div>
      </div>
      <br>
      <br>
      </br>
      <div class="row">
        <div class="col">
            <a href="products.php" class="red_button frame see_more">SEE MORE</a>
        </div>
      </div>
    </div>
  </section>
  <section id="newsletter">
    <div class="text-mid">
        <div class="row">
          <div class="col">
            <img src="image/newsletter_model.png" class="img-fluid" alt="">
          </div>
          <div class="col">
            <form class="" action="" method="post">
              <h3>#MORE SUPRISE TO COME</h3>
              <h2 style="font-size: 70px; color:black; margin-top:0;">SUBSCRIBE FOR A 30% <br>DISCOUNT!</h2>
              <div class="subscribe_field flex" style="border-radius:3px; justify-content:center;">
                <input class="form-control" type="email" name="" value="" placeholder="Email here" style="width:40%; border:none; padding-left:20px;" required>
                <button class="form-control red_button" type="submit" name="button">SUBSCRIBE</button>
              </div>
            </form>
          </div>
        </div>
    </div>
  </section>
  <section id="delivery">

        <div class="row">
          <div class="col flex">
            <div class="ml-auto" style="padding-right: 10px; position:relative; top: 15px;">
              <i class="fas fa-truck  fa-2x" style="color: #fe4c50;"></i>
            </div>
            <div class="mr-auto">
              <h3>FREE SHIPPING</h3>
              <p style="max-width:250px;">Enjoy free delivery right to your doorstep when spend $80.</p>
            </div>
          </div>

          <div class="col flex">
            <div class="ml-auto" style="padding-right: 10px; position:relative; top: 15px;">
              <i class="fas fa-undo fa-2x" style="color: #fe4c50;"></i>
            </div>
            <div class="mr-auto">
              <h3>FREE RETURN</h3>
              <p style="max-width:250px;">We accept exchange or return within 30 days from the date of purchase.</p>
            </div>


          </div>

          <div class="col flex">
            <div class="ml-auto" style="padding-right: 10px; position:relative; top: 15px;">
              <i class="fas fa-question-circle fa-2x" style="color: #fe4c50;"></i>
            </div>
            <div class="mr-auto">
              <h3>CUSTOMER SUPPORT</h3>
              <p style="max-width:250px;">Don't worry. We got you covered 24/7.</p>
            </div>



        </div>

    </div>
  </section>

  <!-- This generates modal -->
    <?php echo file_get_contents("html/modal.html"); ?>








  <!-- This generates footer -->
  <?php echo file_get_contents("html/bottom.html"); ?>
  <script type="text/javascript" src="js/statusMessages.js"></script>
  <script type="text/javascript" src="js/modal.js"></script> <!-- Modal script -->
  <script type="text/javascript" src="js/carousel.js"></script> <!--carousel script -->
  <script type="text/javascript" src="js/banner&btoTop.js"></script> <!-- Banner & B to top button -->

</body>

</html>
