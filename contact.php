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



  <!-- This generates footer -->
  <?php echo file_get_contents("html/bottom.html"); ?>
  <!-- Modal script -->
  <script>
    var modal;
    function openModal(modalname, closemodal){
      this.modal = document.getElementById(modalname);
      modal.style.display = "block";
      closeModal(closemodal);
    }
    function closeModal(modalname){
      var close = document.getElementById(modalname);
      close.style.display = "none";
      resetForm();
    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
        resetForm();
      }
    }

    function resetForm(){
      document.getElementById('loginForm').reset();
      document.getElementById('registerForm').reset();
    }
  </script>
</body>
