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

    <div class="flex ml-auto" style="align-items:center; margin-right:45px;">
      <form class="search-box" action="products.php" method="post">
        <input id="search-box" name="searchbox" type="search" placeholder="Search">
      </form>

      <div class="icon-group">
        <span class="material-icons zoom"><a href="account.php" title="My Account">face</a></span>
        <span class="material-icons zoom"><a href="products.php?page=favourites" title="My Favourites">favorite_border</a></span>
        <span class="material-icons zoom"><a href="products.php?page=cart" title="My Cart">shopping_cart</a></span>
      </div>
    </div>

  </div>
</header>
