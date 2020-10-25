<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>RANDA</title>
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/utility.css">
  <link rel="stylesheet" href="css/carousel.css">
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

  <div id="banner" class="banner" onscroll="myFunction()">
    <div class="row">
      <div class="col flex " style="height:50px; line-height:50px; font-size:16px; margin-left:60px; margin-right:45px; padding-right:0px;">
          FREE SHIPPING ON ORDERS OVER SGD80
          <div class="dropdown ml-auto text-mid">
            <button class="login_dropdown"><?php echo $username; ?></button>
            <div class="dropdown-content">
              <a onclick="openModal('loginModal', 'registerModal')" style="display:<?php echo $dropdown; ?>;">Login</a>
              <a onclick="openModal('registerModal', 'loginModal')" style="display:<?php echo $dropdown; ?>;">Register</a>
            </div>

          </div>
          <div class="logout_icon">
            <a href="action/logout.php" style="display:<?php echo $logout; ?>;"><i class="fas fa-sign-out-alt"></i> </a>
          </div>
      </div>
    </div>
  </div>
  <header id="title">
    <div class="wrapHead">

      <div class="" style="margin-left:40px;">
        <a href="index.php"><img src="image/logo.png" alt="" class="logo"></a>
      </div>
      <nav class="nav frame">

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
            <a class="scroll" href="contact.php">CONTACT</a>
          </li>
        </ul>
      </nav>

      <div class="flex" style="align-items:center; margin-right:45px;">
        <form class="search-box" action="products.php" method="post">
          <input id="search-box" name="searchbox" type="search" placeholder="Search">
        </form>

        <div class="icon-group">
          <span class="material-icons zoom"><a href="account.php" title="My Account">face</a></span>
          <span class="material-icons zoom"><a href="favourites.html" title="My Favourites">favorite_border</a></span>
          <span class="material-icons zoom"><a href="cart.html" title="My Cart">shopping_cart</a></span>
        </div>
      </div>

    </div>
  </header>

  <section id="contact">
    <div class="container-fluid">
      <div class="row" style="padding: 3rem 0;">
      <div class="col-12" >
          <h2 style="font-size:40px;">Ask us anything.</h2>
      </div>
      <div class="col-7" style="border-radius: 6px; box-shadow:0px 8px 35px 10px #E8E8E8; padding:2rem 1rem 2rem 1rem;">
          <form class="" action="" method="post">
            <div class="form-group row">
              <div class="col">
                <label for="">First Name<span>&#42;</span></label><br>
                <input type="text" class="form-control" name="firstname" id="firstname" value="" required>
              </div>
              <div class="col">
                <label for="">Last Name<span>&#42;</span></label><br>
                <input type="text" class="form-control" name="lastname" id="lastname" value="" required>
              </div>
            </div>

            <div class="form-group row">
              <div class="col">
                <label for="">Email<span>&#42;</span></label><br>
                <input type="text" class="form-control" ame="email" id="email" value="" required>
              </div>
            </div>

            <div class="form-group row">
              <div class="col">
                <label for="">Subject</label><br>
                <input type="text" class="form-control" name="subject" id="subject" value="">
              </div>
            </div>

            <div class="form-group row">
              <div class="col">
                <label for="">Message</label><br>
                <textarea class="form-control" name="message" id="message" rows="8" cols="30" style="resize:none;"></textarea>
              </div>

            </div>

            <div class="form-group row">
                <div class="col">
                  <input class="form-control btnSubmit" type="submit" id="submit" name="submit" value="Send Message" style="letter-spacing: 2px;">
                </div>
            </div>
          </form>
        </div>

      <div class="col-5 contact-icon">
          <div class="contact-holder flex" >
            <i class="fas fa-map-marker-alt"></i>
            <p>Hougang Central 530837 Singapore.</p>
          </div>
          <div class="contact-holder flex" >
            <i class="fas fa-phone-alt"></i>
            <p>+65 87141256</p>
          </div>
          <div class="contact-holder flex">
            <i class="far fa-envelope"></i>
            <p>ntu@gmail.com</p>
          </div>
          <!-- <div class="flex" style="justify-content: center;">
            <img src="image/customer_support.png" class="img-fluid" alt="">
          </div> -->
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
