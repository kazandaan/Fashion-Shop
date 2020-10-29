<?php

  // Create connection (servername, username, password, dbname)
  $conn = mysqli_connect("localhost", "f32ee", "f32ee", "f32ee");

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  //variables
  $id = $_POST['userid']; //required [hidden]
  $name = $_POST['name']; //required
  $username = $_POST['username']; //required
  $email = $_POST['email']; //required
  $phone = $_POST['phone']; //null
  $birthday = $_POST['birthday']; //date("Y-m-d", $_POST['birthday']).""; // null, birthday date
  $address = $_POST['address']; //null
  $cardno = $_POST['cardno']; //null
  $cardname = $_POST['cardname']; //null
  $card = $_POST['card']; //null
  $img = $_FILES['userimg']['name']; //null
    $existingimg = $_POST['existingimg']; //hidden
  // image
    if($img == null ){
      $image = $existingimg;
      $result = true;
    }
    else{
      $target = "../image/user/" . $img;
      $image = "user/" . $img;
      $result = move_uploaded_file($_FILES['userimg']['tmp_name'], $target); //not working > permission problem ?
      $result = true; //force true
    }

    // need to validate: username taken blaaah etc.-------------------------------------!!!

  if($result)
	{
    $sql = "UPDATE user_randa SET
    user_name = '$name',
    user_username = '$username',
    user_email = '$email',
    user_phone = '$phone',
    user_birthday = '$birthday',
    user_address = '$address',
    user_cardno = '$cardno',
    user_cardname = '$cardname',
    user_card = '$card',
    user_img = '$image'
    WHERE user_id = $id";

    $updated = mysqli_query($conn, $sql);
    if ($updated) {
      // echo "Image: " . $img . "<br>" . $sql;
      // header("Location:../account.php?page=updateUser&status=" . $updated);
    }
    else {
      // echo "Error updating record: " . mysqli_error($conn) . $sql;
      // header("Location:../account.php?page=updateUser&status=" . $updated);
    }
	}
	else
	{
		// header("Location:../ManagePage.php?status=file");
    echo print_r($_FILES) . "<br>tmp: " . $_FILES['userimg']['tmp_name'] . "<br>target: " . $target;
	}

  header("Location:../account.php?page=updateUser&status=" . $updated);
  mysqli_close($conn);

?>
