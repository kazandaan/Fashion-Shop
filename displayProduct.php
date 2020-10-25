<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>RANDA</title>
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/utility.css">
  <link rel="stylesheet" href="css/carousel.css">
  <link rel="stylesheet" href="css/displayProduct.css">
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
    // Create connection (servername, username, password, dbname)
    $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $id = $_SESSION['userid'];
    $sql = "SELECT * FROM user_randa WHERE user_id = $id"; //get from session
    $runsql = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($runsql);

    $username = $user['user_username'];
    $dropdown = "none";
    $logout = "block";

  }
?>
<body>
  <?php include "html/top.php";?>
  
  <section id="displayproduct">
    <div class="container-fluid">
      <div class="row img-wrapper" style="align-items:center;">
        <div class="col text-mid ">
            <img class="img-fluid" src="image/<?php echo 'women/2.jpg'?>" alt="">
        </div>
        <div class="col">
          <form class="" action="" method="post">
            <div class="product_name attribute">
              <h2><?php echo 'Product_name' ?></h2>
            </div>
            <div class="product_descrption attribute">
              <p><?php echo 'description_here' ?></p>
            </div>
            <div class="price_tag attribute">
              <strong><?php echo 'PRICE_here' ?></strong>
            </div>
            <div class="size_selection attribute">
              <p>Please select your size:</p>
              <div class="flex" style="align-items:center;">
                <input type="radio" id="XS" name="size" value="XS">
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
              <input type="number" name="quantity" id="quantity" value="0" step="1" min="1" max="99">
            </div>

            <div class="flex attribute">
              <input class="form-control btnAdd2cart" type="submit" name="add2cart" id="add2cart" value="ADD TO CART">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>


  <!-- This generates modal -->
  <?php echo file_get_contents("html/modal.html"); ?>

  <!-- This generates footer -->
  <?php echo file_get_contents("html/bottom.html"); ?>

  <script type="text/javascript" src="js/modal.js"></script> <!-- Modal script -->
  <script type="text/javascript" src="js/banner&btoTop.js"></script> <!-- Banner & B to top button -->
</body>
