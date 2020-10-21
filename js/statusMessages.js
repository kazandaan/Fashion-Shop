// index.php, account.php
// registerUser, loginUser, updateUser, updatePassword
function setUpdateStatusDiv( status, message ){
  var div = document.getElementById('updateStatus');

  var colour = "";
  if( status == 1 ){ // GREEN
    colour = "#ADEFAB"; // "rgba(0, 255, 0, 0.2)"
  }
  else{ // status = 0 > RED
    colour = "#EFABAB"; // "rgba(255, 0, 0, 0.2)"
  }
  div.style.display = "block";
  div.style.backgroundColor = colour;

  var header2 = document.getElementById('messageHeader');
  header2.innerHTML = message;

  // remove updateStatusDiv after 3 seconds
  setTimeout(function(){
    div.style.display = "none";
    window.location = window.location.pathname; // removeQueryString from url
    // location.replace("account.php");
  }, 3000);
}
