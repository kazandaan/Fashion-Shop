// index.php, account.php
// registerUser, loginUser, updateUser, updatePassword
function setUpdateStatusDiv( status, message ){
  var div = document.getElementById('updateStatus');

  var colour = "";
  if( status == 0 ){ // RED
    colour = "#F09CA2"; // "rgba(255, 0, 0, 0.2)"
  }
  else if(status == 1 ){ // GREEN
    colour = "#BDF0D6"; // "rgba(0, 255, 0, 0.2)"
  }
  else if( status == 2 ){ // BLUE
    colour = "#B2C4CB";
  }
  div.style.display = "block";
  div.style.backgroundColor = colour;

  var header2 = document.getElementById('messageHeader');
  header2.innerHTML = message;

  // remove updateStatusDiv after 3 seconds
  setTimeout(function(){
    div.style.display = "none";
    var newURL = location.pathname;
    window.history.replaceState('object', document.title, newURL); // removeQueryString from url without refreshing
    // location.replace("account.php");
  }, 3000);
}
