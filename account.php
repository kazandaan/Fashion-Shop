<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>RANDA - Account</title>
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/account.css">
  <link rel="stylesheet" href="css/carousel.css">
  <link rel="stylesheet" href="css/utility.css">
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="apple-touch-icon" sizes="180x180" href="image/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="image/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="image/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">

  <style>

  </style>
</head>

<!-- Check Session -->
<?php
  session_start();
  if(!isset($_SESSION['userid'])){
    header("Location:index.php");
  }
  else{
    $id = $_SESSION['userid'];
  }

  // GET username to show on banner
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

      <div class="flex mr-auto" style="align-items:center; margin-right:45px;">
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


  <!-- START SCRIPT | Window ONLOAD, $_GET Stuff -->
  <script type="text/javascript" src="js/statusMessages.js"></script>
  <script>
    window.onload = function(){
  <?php
    if( isset($_GET['page']) && isset($_GET['status'])){
      $page = $_GET['page'];
      $status = $_GET['status'];

      $message = "";
      if( $page == "updateUser" && $status == 1){
        $message = "Profile Successfully Updated";
      }
      else if( $page == "updateUser" && $status == 0){
        $message = "Profile Failed to Update";
      }
      else if( $page == "updatePassword" && $status == 1){
        $message = "Password Successfully Updated";
      }
      else if( $page == "updatePassword" && $status == 0){
        $message = "Password Failed to Update";
      }
      echo "setUpdateStatusDiv( ".$status.", '".$message."' )";
    }
  ?>
    } // end of window.onload = function()
  </script>
  <!-- END SCRIPT | Window ONLOAD, $_GET Stuff -->

  <section></section>

  <?php
    // Create connection (servername, username, password, dbname)
    $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM user_randa WHERE user_id = $id"; //get from session
    $runsql = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($runsql);
  ?>

  <div id="account">
    <h1>Welcome <?php echo $user['user_name']; ?></h1>

    <div class="flex">

      <div id="leftside">
        <div id="userimage" style="background-image: url('image/<?php echo $user['user_img']; ?>');">
          <div class="icon-group" id="changePhotoBtn">
            <span><label class="material-icons" for="userimg"><a title="change photo">photo_camera</a></label></span>
          </div>
        </div>

        <form id="logoutForm" action="action/logout.php" method="post" class="buttons">
          <input type="submit" value="Logout"/>
        </form>
      </div>

      <div id="rightSide">
        <form name="accountForm" action="action/updateUser.php" method="POST" enctype="multipart/form-data">
          <!-- Editing Block -->
          <div id="editMode" class="flex">
            <b>* EDITING MODE *</b>
            <div class="buttons" class="flex">
              <input type="submit" value="Update Details"/> &nbsp;
              <input type="button" onclick="cancelEdit()" value="Cancel"/>
            </div>
          </div>

          <div id="userdetails">
            <div class="icon-group" id="editDetailsBtn"><span class="material-icons"><a href="#" onclick="editDetails()" title="edit profile">edit</a></span></div>
            <div id="accountInfo">
              <u><h3>Account Information</h3></u>
              <input type="hidden" name="userid" id="userid" value="<?php echo $user['user_id']; ?>">
              <label>Username:</label><input type="text" name="username" id="username" value="<?php echo $user['user_username']; ?>" disabled></input><br>
              <label style="margin-right:7px;">Password:</label><a onclick="openModal()">Change Password</a><br>

            </div>
            <div id="perosnalInfo">
              <u><h3>Personal Information</h3></u>
              <label>Name:</label><input type="text" name="name" id="name" value="<?php echo $user['user_name']; ?>" disabled></input><br>
              <label>Email:</label><input type="email" name="email" id="email" value="<?php echo $user['user_email']; ?>" disabled></input> <br>
              <label>Phone:</label><input type="text" name="phone" id="phone" value="<?php echo $user['user_phone']; ?>" disabled></input> <br>
              <label>Birthday:</label><input type="date" name="birthday" id="birthday" min="2002-01-01" value="0000-00-00" disabled></input> <br> <?php echo $user['user_birthday']; ?>
              <label>Address:</label><input type="text" name="address" id="address" value="<?php echo $user['user_address']; ?>" disabled></input> <br>
              <input type="file" name="userimg" id="userimg" onchange="displayimg()"/><input type="hidden" name="existingimg" value="<?php echo $user['user_img']; ?>">
            </div>
            <div id="paymentInfo">
              <u><h3>Payment Information</h3></u>
              <label>Card No:</label><input type="text" name="cardno" id="cardno" value="<?php echo $user['user_cardno']; ?>" disabled></input><br>
              <label>Name on Card:</label><input type="text" name="cardname" id="cardname" value="<?php echo $user['user_cardname']; ?>" disabled></input><br>
              <label>Type:</label>
              <select name="card" id="card" disabled>
                <option disabled selected style="display:none;"><?php echo $user['user_card']; ?></option> <!-- how to not repeat -->
                <option value="Visa">Visa</option>
                <option value="MasterCard">MasterCard</option>
              </select><br>
            </div>
          </div>
        </form>
      </div><!--end rightSide div-->
    </div><!--end flex div-->

    <!-- Password Modal -->
    <div id="passwordModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <form name="passwordForm" action="action/updatePassword.php" method="POST" >
          <h2>Change Password</h2>
          <input type="hidden" name="userid" id="userid" value="<?php echo $user['user_id']; ?>">
          <label>Current Password:</label><input type="password" name="oldpassword" id="oldpassword" required></input><br>
          <label>New Password:</label><input type="password" name="newpassword" id="newpassword" required></input><br>
          <label>Confirm Password:</label><input type="password" name="confirmpassword" id="confirmpassword" required></input><br>
          <div class="buttons">
            <input type="submit" value="Change Password"/>
          </div>
        </form>
      </div>
    </div>
    <!-- End Password Modal -->
  </div><!-- End account div -->

  <!-- Popup Block -->
  <div class="messagePopup" id="updateStatus">
    <h2 id="messageHeader"></h2>
  </div>

  <?php
    mysqli_close($conn);
  ?>

  <!-- This generates footer -->
  <?php echo file_get_contents("html/bottom.html"); ?>

  <script type="text/javascript" src="js/account.js"></script>

</body>
</html>
