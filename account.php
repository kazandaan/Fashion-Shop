<!--
Account Page
Display User details
User can Edit Details, Change Password, View Orders
-->

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>RANDA - Account</title>
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/account.css">
  <link rel="stylesheet" href="css/utility.css">
  <link rel="stylesheet" href="css/loginmodal.css">
  <link rel="stylesheet" href="css/responsive.css">
  <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="apple-touch-icon" sizes="180x180" href="image/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="image/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="image/favicon-16x16.png">

  <style>

  </style>
</head>

<!-- Check Session -->
<?php
  session_start();
  if(!isset($_SESSION['userid'])){
    header("Location:index.php?page=unauthorized&status=2");
  }
  else{
    $id = $_SESSION['userid'];
    $username = $_SESSION['username'];
    $dropdown = "none";
    $logout = "block";
  }
?>

<body>
  <!-- This generates nav and banner -->
  <?php include "html/top.php"; ?>

  <!-- START SCRIPT | Window ONLOAD, $_GET Stuff -->
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
      echo "setUpdateStatusDiv( ".$status.", '".$message."');";
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

    <div class="flex contentwrapper">

      <div id="leftside">
        <div id="userimage" style="background-image: url('image/<?php echo $user['user_img']; ?>');">
          <div class="icon-group" id="changePhotoBtn">
            <span><label class="material-icons" for="userimg"><i class="fa fa-camera" aria-hidden="true" title="change photo"></i></label></span>
          </div>
        </div>

        <form id="logoutForm" action="action/logout.php" method="post" class="">
            <input type="button" class="red_button" onclick="viewOrders()" value="VIEW ORDERS"/>
            <input type="submit" class="red_button" value="LOGOUT"/>
        </form>
      </div>

      <div id="rightSide">
        <form name="accountForm" action="action/updateUser.php" method="POST" enctype="multipart/form-data">
          <!-- Editing Block -->
          <div id="editMode" class="flex" style="line-height: 50px;">
            <b>&nbsp;<span id="errorMsg"></span></b>
            <div class="flex">
              <input type="submit" class="red_button" value="UPDATE DETAILS"/> &nbsp;
              <input type="button" class="red_button" onclick="cancelEdit()" value="CANCEL"/>
            </div>
          </div>

          <div id="userdetails">
            <div class="" id="editDetailsBtn"><i class="far fa-edit fa-2x" onclick="editDetails()" title="edit profile"></i></div>

            <div id="accountInfo">
              <u><h3>Account Information</h3></u>
              <input type="hidden" name="userid" id="userid" value="<?php echo $user['user_id']; ?>">
              <label>Username:</label><input type="text" name="username" id="username" pattern="[a-zA-Z0-9-]+" value="<?php echo $user['user_username']; ?>" oninvalid="this.setCustomValidity('Only letters and numbers')" onchange="this.setCustomValidity('')" disabled required></input><br>
              <label style="margin-right:7px;">Password:</label><a onclick="openModal(passwordModal)">Change Password</a><br>

            </div>
            <div id="perosnalInfo">
              <u><h3>Personal Information</h3></u>
              <label>Name:</label><input type="text" name="name" id="name" value="<?php echo $user['user_name']; ?>" pattern="[a-zA-Z]+" oninvalid="this.setCustomValidity('Only letters')" onchange="this.setCustomValidity('')" disabled required></input><br>
              <label>Email:</label><input type="email" name="email" id="email" value="<?php echo $user['user_email']; ?>" disabled required></input> <br>
              <label>Phone:</label><input type="text" name="phone" id="phone" value="<?php echo $user['user_phone']; ?>" disabled pattern="[8-9]{1}[0-9]{7}" oninvalid="this.setCustomValidity('8 digits, starting with 8 or 9')" onchange="this.setCustomValidity('')"></input> <br>
              <label>Birthday:</label><input type="date" name="birthday" id="birthday" min="1920-01-01" max="2002-01-01" value="<?php echo $user['user_birthday']; ?>" disabled></input> <br>
              <label>Address:</label><input type="text" name="address" id="address" value="<?php echo $user['user_address']; ?>" disabled></input> <br>
              <input type="file" name="userimg" id="userimg" onchange="displayimg()"/><input type="hidden" name="existingimg" value="<?php echo $user['user_img']; ?>">
            </div>
            <div id="paymentInfo">
              <u><h3>Payment Information</h3></u>
              <label>Card No:</label><input type="text" name="cardno" id="cardno" value="<?php echo $user['user_cardno']; ?>" disabled></input><br>
              <label>Name on Card:</label><input type="text" name="cardname" id="cardname" value="<?php echo $user['user_cardname']; ?>" disabled></input><br>
              <label>Type:</label>
              <select name="card" id="card" disabled>
                <option disabled selected style="display:none;"></option>
                <option id="Visa" value="Visa">Visa</option>
                <option id="MasterCard" value="MasterCard">MasterCard</option>
              </select><br>
            </div>
          </div>
        </form>
      </div><!--end rightSide div-->
    </div><!--end flex div-->


  </div><!-- End account div -->

  <script>
    // set select option CARD TYPE from db
    var cardtype = document.getElementById("<?php echo $user['user_card']; ?>");
    cardtype.selected = true;
  </script>

  <?php
    mysqli_close($conn);
  ?>

  <?php echo file_get_contents("html/modal.html"); ?>
  <!-- This generates footer -->
  <?php echo file_get_contents("html/bottom.html"); ?>


  <script type="text/javascript" src="js/statusMessages.js"></script>
  <script type="text/javascript" src="js/modal.js"></script> <!-- Modal script -->
  <script type="text/javascript" src="js/banner&btoTop.js"></script>
  <script type="text/javascript" src="js/account.js"></script>
  <script type="text/javascript" src="js/sidebar.js"></script>
</body>
</html>
