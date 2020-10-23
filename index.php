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

      <!-- Check Session -->
      <?php
        session_start();
        // $account = "";
        if(!isset($_SESSION['userid'])){
          $account = "onclick=\"openModal('loginModal')\"";
        }
        else{
          $account = "href='account.php'";
        }
      ?>

      <div class="icon-group">
        <!-- PHP > check session > no user > openModal('loginModal') ; got user > account.html -->
        <span class="material-icons"><a <?php echo $account; ?> title="My Account">face</a></span>
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
    if( isset($_GET['page']) && isset($_GET['status'])){
      $page = $_GET['page'];
      $status = $_GET['status'];

      $message = "";
      // loginUser > 1 > account.php
      if( $page == "loginUser" && $status == 0){
        $message = "Failed to Login";
      }
      else if( $page == "registerUser" && $status == 1){
        $message = "Successfully Registered";
      }
      else if( $page == "registerUser" && $status == 0){
        $message = "Failed to Register";
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
              <h2>SUMMER NEW ARRIVAL</h2>
              <h3>BUY NOW</h3>
            </div>
          </div>
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>


      </div>
    </div>
  </section>


  <section id="categories">

    <div class="container-fluid">
      <div class="title-section">
        <h2 class="">Categories</h2>
      </div>

      <div class="flex text-mid">
        <div class="frame zoom">
          <img src="https://via.placeholder.com/300x200.png?text=WOMEN" alt="WOMEN">
        </div>
        <div class="frame zoom">
          <img src="https://via.placeholder.com/300x200.png?text=MEN" alt="MEN">
        </div>
        <div class="frame zoom">
          <img src="https://via.placeholder.com/300x200.png?text=KIDS" alt="KIDS">
        </div>
      </div>

    </div>

  </section>

  <section id="collection">
    <div class="container-fluid">
      <div class="title-section">
        <h2>Our Collection</h2>
      </div>
    </div>

  </section>

  <section id="new arrival">
    <div class="container-fluid  ">
      <div class="title-section">
        <h2>New Arrival</h2>
      </div>
    </div>
  </section>

  <section id="delivery">
    <div class="container-fluid">
        <div class="row">
          <div class="col flex">
            <div style="padding-right: 10px; position:relative; top: 15px;">
              <i class="fas fa-truck  fa-2x"></i>
            </div>
            <div>
              <h3>FREE SHIPPING</h3>
              <p>Lorem ipsum dolor amet mustache knausgaard +1, blue bottle waistcoat tbh semiotics artisan synt</p>
            </div>
          </div>

          <div class="col flex">
            <div style="padding-right: 10px; position:relative; top: 15px;">
              <i class="fas fa-undo fa-2x"></i>
            </div>
            <div class="">
              <h3>FREE RETURN</h3>
              <p>Lorem ipsum dolor amet mustache knausgaard +1, blue bottle waistcoat tbh semiotics artisan synt</p>
            </div>


          </div>

          <div class="col flex">
            <div style="padding-right: 10px; position:relative; top: 15px;">
              <i class="fas fa-question-circle fa-2x"></i>
            </div>
            <div class="">
              <h3>CUSTOMER SUPPORT</h3>
              <p>Lorem ipsum dolor amet mustache knausgaard +1, blue bottle waistcoat tbh semiotics artisan synt</p>
            </div>


          </div>
        </div>

    </div>
  </section>

  <section id="newsletter">
    <div class="newsletter_content text-mid">
      <div class="" style="padding:15px 0 80px 0;">
        <div class="row">
          <div class="col">
              <h2 style="font-size: 70px; color:white;">SUBSCRIBE FOR A 30% <br>DISCOUNT!</h2>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <form class="" action="" method="post">
              <input type="email" name="" value="" placeholder="Email here" style="width:70%; height:46px; ">
              <button type="submit" name="button" style="height:46px;">SUBSCRIBE</button>
            </form>

          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Login Modal -->
  <div id="loginModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('loginModal')">&times;</span>
      <form id="loginForm" name="loginForm" action="action/loginUser.php" method="POST">
        <h2>Login</h2>
        <label>Username:</label><input type="text" name="username" id="username" required></input><br>
        <label>Password:</label><input type="password" name="password" id="password" required></input><br>
        <div class="buttons">
          <input type="submit" value="Login"/> &nbsp;
        </div>
        Don't have an account? <a href="#" onclick="openModal('registerModal', 'loginModal')">Click here</a> to Register!
      </form>
    </div>
  </div>
  <!-- End Login Modal -->

  <!-- Register Modal -->
  <div id="registerModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('registerModal')">&times;</span>
      <form id="registerForm" name="registerForm" action="action/registerUser.php" method="POST">
        <h2>Register</h2>
        <label>Name:</label><input type="text" name="name" id="name" required></input><br>
        <label>Email:</label><input type="email" name="email" id="email" required></input> <br>
        <label>Username:</label><input type="text" name="username" id="username" required></input><br>
        <label>Password:</label><input type="password" name="password" id="password" required></input><br>
        <label>Confirm Password:</label><input type="password" name="confirmpassword" id="confirmpassword" required></input><br>
        <div class="buttons">
          <input type="submit" value="Register"/> &nbsp;
        </div>
        Have an account? <a href="#" onclick="openModal('loginModal', 'registerModal')">Click here</a> to Login!
      </form>
    </div>
  </div>
  <!-- End Register Modal -->

  <!-- Popup Block -->
  <div class="messagePopup" id="updateStatus">
    <h2 id="messageHeader"></h2>
  </div>

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




  <script type="text/javascript" src="js/carousel.js"></script>

</body>

</html>
