<div id="banner" class="banner" onscroll="myFunction()">
  <div class="row">
    <div class="col flex" style="line-height:50px; font-size:16px; margin-left:60px; margin-right:45px; padding-right:0px;
   justify-content:center;">
        <div class="dropdown ml-auto text-mid" style="align-items:center;">
          <button class="login_dropdown"><?php echo $username ?></button>
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

    <div class="logo-wrapper" style="margin-left:40px;">
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
          <a class="scroll" href="products.php">SHOP</a>
        </li>
        <li class="nav-item">
          <a class="scroll" href="contact.php">CONTACT</a>
        </li>
      </ul>
    </nav>

    <div class="flex ml-auto" style="align-items:center; margin-right:45px;">
      <form class="search-box" action="products.php" method="post">
        <input id="search-box" name="searchbox" type="search" placeholder="Search">
      </form>

      <?php
        // Create connection (servername, username, password, dbname)
        $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

        // Check connection
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        $cart_sql = "SELECT * FROM cart_randa WHERE user_id = $id"; //get from session
        $cart_runsql = mysqli_query($conn, $cart_sql);
        $cartItems = 0; $cartDisplay = "none";
        if( mysqli_num_rows($cart_runsql) > 0 ){
          while($cart = mysqli_fetch_assoc($cart_runsql)){
            $cartItems += $cart['quantity'];
          }
          $cartDisplay = "block";
        }

        $fav_sql = "SELECT * FROM rating_randa WHERE rating_favourite = 1 AND user_id = $id"; //get from session
        $fav_runsql = mysqli_query($conn, $fav_sql);
        $favItems = 0; $favDisplay = "none";
        if( mysqli_num_rows($fav_runsql) > 0 ){
          $favItems = mysqli_num_rows($fav_runsql);
          $favDisplay = "block";
        }
      ?>

      <div class="icon-group">
        <i class="far fa-user-circle" onclick="location.href='account.php'"></i>
        <i class="far fa-heart" onclick="location.href='products.php?page=favourites'">
          <span id="favitemNo" class="itemNo" style="display:<?php echo $favDisplay; ?>;"><?php echo $favItems; ?></span> <!--echo here-->
          <!--display none when user not logged in or item no. = 0-->
        </i>
        <i class="fas fa-shopping-cart" onclick="location.href='products.php?page=cart'">
          <span id="cartitemNo" class="itemNo" style="display:<?php echo $cartDisplay; ?>;"><?php echo $cartItems; ?></span> <!--echo here-->
          <!--display none when user not logged in or item no. = 0 -->
        </i>

      </div>

      <i id="nav_res" class="fas fa-bars fa-2x" onclick="opensidebar()"></i>

    </div>

  </div>
</header>

<div id="sidebarwrapper" class="" >
  <div class="" id="blocker" onclick="closesidebar()"></div>
  <div id="verticalnav" class="flex" style="flex-direction:column; ">
    <span class="close2" onclick="closesidebar()">&times;</span>
    <ul class="text-mid" style="padding-inline-start: 0px;">
      <li><a href="index.php"><img src="image/logo.png" alt="" class="logo"></a></li>
      <li><a href="index.php">HOME</a></li>
      <li><a href="products.php?category=women">WOMEN'S</a></li>
      <li><a href="products.php?category=men">MEN'S</a></li>
      <li><a href="products.php?category=kids">KIDS'</a></li>
      <li><a href="products.php">SHOP</a></li>
      <li><a href="contact.php">CONTACT</a></li>
    </ul>
  </div>
</div>
