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


</head>

<body>
  <div class="banner">
    <div class="row">
      <div class="col flex" style="height:50px; line-height:50px; font-size:16px; margin-left:60px; margin-right:45px;">
          FREE SHIPPING ON ORDERS OVER SGD80
          <div class="ml-auto">
            My ACCOUNT
          </div>
      </div>
    </div>
  </div>
  <header id="title">
    <div class="wrapHead">

      <div class="ml-auto">
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
            <a class="scroll" href="#">CONTACT</a>
          </li>
        </ul>
      </nav>

      <div class="flex mr-auto">
        <form class="search-box" method="post">
          <input id="search-box" type="search" placeholder="Search">
        </form>

        <div class="icon-group">
          <!-- PHP > check session > no user > openModal('loginModal') ; got user > account.html -->
          <span class="material-icons"><a <?php echo $account; ?> title="My Account">face</a></span>
          <span class="material-icons"><a href="favourites.html" title="My Favourites">favorite_border</a></span>
          <span class="material-icons"><a href="cart.html" title="My Cart">shopping_cart</a></span>
        </div>
      </div>


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
              <div class="slide_description1 text-mid" style="margin-top: 30%;">
                <h3>#GRAB US NOW</h3>
                <h2 style="font-size: 50px;">GET UP TO 30% NEW ARRIVAL</h2>
                <a href="#" class="red_button frame">SHOP NOW</a>
              </div>
            </div>
          </div>
        </div>

        <div class="mySlides fade">
          <div class="row">
            <div class="col">
              <img src="image/model.png" class="img-fluid">
            </div>
            <div class="col">
              <div class="slide_description2">
                <h3>2nd</h3>
                <h2>GET UP TO 30% NEW ARRIVAL</h2>
                <a href="#" class="">SHOP NOW</a>
              </div>
            </div>
          </div>
        </div>

        <div class="mySlides fade">
          <div class="row">
            <div class="col">
              <img src="image/model.png" class="img-fluid">
            </div>
            <div class="col">
              <div class="slide_description3">
                <h3>3rd</h3>
                <h2>GET UP TO 30% NEW ARRIVAL</h2>
                <a href="#">SHOP NOW</a>
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
              <a href="#">WOMEN'S</a>
            </div>
        </div>
        <div class="col zoom banner-item" style="background-image:url(image/girl_banner.jpg)">
          <div class="banner-category">
              <a href="#">KIDS'</a>
          </div>
          <!-- <img src="https://via.placeholder.com/300x200.png?text=MEN" alt="MEN"> -->
        </div>
        <div class="col zoom banner-item" style="background-image:url(image/man_banner.jpg)">
            <div class="banner-category">
                <a href="#">MEN'S</a>
            </div>
          <!-- <img src="https://via.placeholder.com/300x200.png?text=KIDS" alt="KIDS"> -->
        </div>
      </div>
  </section>

  <section id="new-arrival">
    <div class="container-fluid">
      <div class="title-section">
        <h2>New Arrival</h2>
      </div>
      <div class="row">
        <div class="col">
          <a href="#" class="product-item">
            <img class="img-fluid" src="https://cdn11.bigcommerce.com/s-pkla4xn3/images/stencil/1280x1280/products/13648/135217/Female-Blusas-Spring-Autumn-Blouse-Office-Lady-Slim-Pink-Shirts-Women-Blouses-Leisure-Long-Sleeve-Plus__49882.1544087736.jpg?c=2?imbypass=on" alt=""></a>
          <h3 class="item-title">Product 1</h3>
          <strong>$8.00</strong>
        </div>
        <div class="col">
          <a href="#" class="product-item">
            <img class="img-fluid" src="https://cdn11.bigcommerce.com/s-pkla4xn3/images/stencil/1280x1280/products/13648/135217/Female-Blusas-Spring-Autumn-Blouse-Office-Lady-Slim-Pink-Shirts-Women-Blouses-Leisure-Long-Sleeve-Plus__49882.1544087736.jpg?c=2?imbypass=on" alt=""></a>
          <h3 class="item-title">Product 2</h3>
          <strong>$8.00</strong>
        </div>
        <div class="col">
          <a href="#" class="product-item">
            <img class="img-fluid" src="https://cdn11.bigcommerce.com/s-pkla4xn3/images/stencil/1280x1280/products/13648/135217/Female-Blusas-Spring-Autumn-Blouse-Office-Lady-Slim-Pink-Shirts-Women-Blouses-Leisure-Long-Sleeve-Plus__49882.1544087736.jpg?c=2?imbypass=on" alt=""></a>
          <h3 class="item-title">Product 3</h3>
          <strong>$8.00</strong>
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
          <a href="#" class="product-item">
            <img class="img-fluid" src="https://preview.colorlib.com/theme/shopmax/images/prod_2.png" alt=""></a>
          <h3 class="item-title">Product 1</h3>
          <strong>$8.00</strong>
        </div>
        <div class="col">
          <a href="#" class="product-item">
            <img class="img-fluid" src="https://media.lovebonito.com/media/catalog/product/t/h/th1375-031-1_4.jpg?width=480&height=672" alt=""></a>
          <h3 class="item-title">Product 2</h3>
          <strong>$8.00</strong>
        </div>
        <div class="col">
          <a href="#" class="product-item">
            <img class="img-fluid" src="https://preview.colorlib.com/theme/shopmax/images/model_5.png" alt=""></a>
          <h3 class="item-title">Product 3</h3>
          <strong>$8.00</strong>
        </div>
      </div>
      <div class="row text-mid">
        <div class="col">
          <a href="#" class="product-item">
            <img class="img-fluid" src="https://cdn11.bigcommerce.com/s-pkla4xn3/images/stencil/1280x1280/products/13648/135217/Female-Blusas-Spring-Autumn-Blouse-Office-Lady-Slim-Pink-Shirts-Women-Blouses-Leisure-Long-Sleeve-Plus__49882.1544087736.jpg?c=2?imbypass=on" alt=""></a>
          <h3 class="item-title">Product 1</h3>
          <strong>$8.00</strong>
        </div>
        <div class="col">
          <a href="#" class="product-item">
            <img class="img-fluid" src="https://cdn11.bigcommerce.com/s-pkla4xn3/images/stencil/1280x1280/products/13648/135217/Female-Blusas-Spring-Autumn-Blouse-Office-Lady-Slim-Pink-Shirts-Women-Blouses-Leisure-Long-Sleeve-Plus__49882.1544087736.jpg?c=2?imbypass=on" alt=""></a>
          <h3 class="item-title">Product 2</h3>
          <strong>$8.00</strong>
        </div>
        <div class="col">
          <a href="#" class="product-item">
            <img class="img-fluid" src="https://cdn11.bigcommerce.com/s-pkla4xn3/images/stencil/1280x1280/products/13648/135217/Female-Blusas-Spring-Autumn-Blouse-Office-Lady-Slim-Pink-Shirts-Women-Blouses-Leisure-Long-Sleeve-Plus__49882.1544087736.jpg?c=2?imbypass=on" alt=""></a>
          <h3 class="item-title">Product 3</h3>
          <strong>$8.00</strong>
        </div>
      </div>
      <br>
      <br>
      </br>
      <div class="row">
        <div class="col">
            <a href="#" class="red_button" style="margin:auto;">SEE MORE</a>
        </div>
      </div>
    </div>
  </section>



  <section id="newsletter">
    <div class="text-mid">
        <div class="row">
          <div class="col">
            <img src="https://preview.colorlib.com/theme/shopmax/images/model_6.png" class="img-fluid" alt="">
          </div>
          <div class="col">
            <form class="" action="" method="post">
              <h3>#MORE SUPRISE TO COME</h3>
              <h2 style="font-size: 70px; color:black; margin-top:0;">SUBSCRIBE FOR A 30% <br>DISCOUNT!</h2>
              <input type="email" name="" value="" placeholder="Email here" style="width:40%; height:46px; ">
              <button type="submit" name="button" style="height:46px;">SUBSCRIBE</button>
            </form>
          </div>
        </div>
    </div>
  </section>

  <section id="delivery">

        <div class="row">
          <div class="col flex">
            <div style="padding-right: 10px; position:relative; top: 15px;">
              <i class="fas fa-truck  fa-2x" style="color: #fe4c50;"></i>
            </div>
            <div>
              <h3>FREE SHIPPING</h3>
              <p>Lorem ipsum dolor amet mustache knausgaard +1, blue bottle waistcoat tbh semiotics artisan synt</p>
            </div>
          </div>

          <div class="col flex">
            <div style="padding-right: 10px; position:relative; top: 15px;">
              <i class="fas fa-undo fa-2x" style="color: #fe4c50;"></i>
            </div>
            <div class="">
              <h3>FREE RETURN</h3>
              <p>Lorem ipsum dolor amet mustache knausgaard +1, blue bottle waistcoat tbh semiotics artisan synt</p>
            </div>


          </div>

          <div class="col flex">
            <div style="padding-right: 10px; position:relative; top: 15px;">
              <i class="fas fa-question-circle fa-2x" style="color: #fe4c50;"></i>
            </div>
            <div class="">
              <h3>CUSTOMER SUPPORT</h3>
              <p>Lorem ipsum dolor amet mustache knausgaard +1, blue bottle waistcoat tbh semiotics artisan synt</p>
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
        <h3>CATEGORIES</h3>
        <ul>
          <li><a href="products.php?category=women">Women</a></li>
          <li><a href="products.php?category=men">Men</a></li>
          <li><a href="products.php?category=kids">Kids</a></li>
        </ul>
      </div>
      <div class="col">
        <h3>ACCOUNT</h3>
        <ul>
          <li><a href="#">My Account</a></li>
          <li><a href="#">Order</a></li>
          <li><a href="#">Checkout</a></li>
          <li><a href="#">Wishlist</a></li>
        </ul>
      </div>
      <div class="col">
        <h3>HELP</h3>
        <ul>
          <li><a href="#">Shipping</a></li>
          <li><a href="#">Return</a></li>
          <li><a href="#">FAQ</a></li>
        </ul>
      </div>
      <div class="col">
        <h3>CONTACT INFO</h3>
        <div style=" position:relative;">
          <ul>
            <li class="address flex"><i class="fas fa-map-marker-alt"></i> <div class="">
              Hougang Central 530837 Singapore.
            </div> </li>
            <li class="phone flex"><i class="fas fa-phone-alt"></i><div class="">
               +65 87141256
            </div> </li>
            <li class="email flex"><i class="far fa-envelope"></i><div class="">
               ntu@gmail.com
            </div></li>
          </ul>
        </div>

      </div>
    </div>
    <div class="">
    </div>
    <div class="text-mid">
      @Copyright 2020 Randa
    </div>
  </footer>




  <script type="text/javascript" src="js/carousel.js"></script>

</body>

</html>
