<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>RANDA</title>
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/utility.css">
  <link rel="stylesheet" href="css/carousel.css">
  <link rel="stylesheet" href="css/loginmodal.css">
  <link rel="stylesheet" href="css/responsive.css">
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

  <!-- This generates nav and banner -->
  <?php include "html/top.php"; ?>

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
                  <input class="form-control btnSubmit" type="submit" id="submit" name="submit" value="Send Message">
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
  <script type="text/javascript" src="js/sidebar.js"></script>
</body>
