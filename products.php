<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>RANDA</title>
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/utility.css">
  <link rel="stylesheet" href="css/carousel.css">
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="apple-touch-icon" sizes="180x180" href="image/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="image/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="image/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">

</head>

<body>
  <header id="title">
    <div class="wrapHead">
      <div>
        <a href="index.php"><img src="image/logo.png" alt="" class="logo"></a>
      </div>
      <nav class="nav">

        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="scroll" href="index.php">HOME</a>
          </li>
          <li class="nav-item">
            <a class="scroll" href="products.php?category=women">WOMEN'S</a>
          </li>
          <li class="nav-item">
            <a class="scroll" href="products.php?category=men">MEN'S</a>
          </li>
          <li class="nav-item">
            <a class="scroll" href="products.php?category=kids">KIDS'</a>
          </li>
          <li class="nav-item">
            <a class="scroll" href="#">SHOP</a>
          </li>
          <li class="nav-item">
            <a class="scroll" href="#">CONTACT</a>
          </li>
        </ul>
      </nav>

      <form class="search-box" method="post">
        <input id="search-box" type="search" placeholder="Search">
      </form>

      <div class="icon-group">
        <span class="material-icons"><a href="account.php" title="My Account">face</a></span>
        <span class="material-icons"><a href="favourites.php" title="My Favourites">favorite_border</a></span>
        <span class="material-icons"><a href="cart.html" title="My Cart">shopping_cart</a></span>
      </div>
    </div>
  </header>

  <!-- START SCRIPT | Window ONLOAD, $_GET Stuff -->
  <script type="text/javascript" src="js/statusMessages.js"></script>
  <script>
    window.onload = function(){
  <?php
    if( isset($_GET['category']) ){
      $category = $_GET['category'];

    }
  ?>
    } // end of window.onload = function()
  </script>
  <!-- END SCRIPT | Window ONLOAD, $_GET Stuff -->

  <style>
    #products{
      letter-spacing: 2px;
      font-size: 20px;
      line-height: 1.6;
    }
    #products h1{
      /* background-color: red; */
      font-size: 60px;
      text-align: center;
    }
    #products .productrow{
      /* background-color: red; */
      margin-bottom: 50px;
      padding-top: 50px;
    }
    #products .productrow span{
      margin: 0px auto 10px auto;
    }
    #products .productrow span a{
      color: black;
      text-decoration: none;
    }
    #products .productrow img{
      height: 300px;
      width: 250px;
    }
    #products .productrow p{
      margin: auto;
      width: 200px;
    }

  </style>



  <div id="products">
    <h1><?php echo ucfirst($category); ?></h1>
    <hr>
    <?php
      // Create connection (servername, username, password, dbname)
      $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

      // Check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
    ?>

    <section id="categories">
      <div class="container-fluid">

        <?php
          $sql = "SELECT * FROM product_randa WHERE product_category = '$category'";
          $runsql = mysqli_query($conn, $sql);
          $closeddiv = false;
          $count = 0; // 3 per row
          while ($product = mysqli_fetch_assoc($runsql)) {
            $count++;
            if( $count % 3 == 1 ){ // first image of row
              echo "<div class='flex text-mid productrow'>";
              $closeddiv = false;
            }
        ?>
            <div class="frame zoom">
              <!-- fav and add to cart button -->
              <div class="flex">
                <span class="material-icons"><a onclick="" title="unlike">favorite</a></span>
                <span class="material-icons"><a onclick="" title="add to cart">add_shopping_cart</a></span>
              </div>

              <img src="image/<?php echo $product['product_img']; ?>" alt="<?php echo $product['product_name']; ?>">
              <p><?php echo $product['product_name']; ?></p>
              <p>$<?php echo number_format((float)$product['product_price'], 2); ?></p>
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
      ?>


    </section>
  </div> <!-- end of favourites div -->

  <footer>
    <div class="container-fluid frame row">
      <div class="col">
        <h4>CATEGORIES</h4>
        <ul>
          <li><a href="products.php?category=women">Women</a></li>
          <li><a href="products.php?category=men">Men</a></li>
          <li><a href="products.php?category=kids">Kids</a></li>
        </ul>
      </div>
      <div class="col">
        <h4>ACCOUNT</h4>
        <ul>
          <li><a href="#">My Account</a></li>
          <li><a href="#">Order</a></li>
          <li><a href="#">Checkout</a></li>
          <li><a href="#">Wishlist</a></li>
        </ul>
      </div>
      <div class="col">
        <h4>HELP</h4>
        <ul>
          <li><a href="#">Shipping</a></li>
          <li><a href="#">Return</a></li>
          <li><a href="#">FAQ</a></li>
        </ul>
      </div>
      <div class="col">
        <img src="https://via.placeholder.com/300x200.png?text=HOLDER" alt="">
      </div>
    </div>
    @Copyright 2020 Randa
  </footer>
</body>
</html>
