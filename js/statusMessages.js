// index.php, account.php
// registerUser, loginUser, updateUser, updatePassword
var msgBackground = document.getElementById("msgBackground");
function setUpdateStatusDiv( status, message ){
  var div = document.getElementById('updateStatus');

  var colour = "";
  if( status == 0 ){ // RED // FAIL
    msgBackground.setAttribute("src","image/svg/denied.svg");
  }
  else if(status == 1 ){ // GREEN // PASS
    msgBackground.setAttribute("src","image/svg/welcome.svg");
  }
  else if( status == 2 ){ // BLUE // NOTIFY
    msgBackground.setAttribute("src","image/svg/logintoviewpg.svg");
  }
  else if( status == 3 ){ // BLUE // NOTIFY
    msgBackground.setAttribute("src","image/svg/regSuccess.svg");
  }
  div.style.display = "block";
  div.style.backgroundColor = colour;

  var header2 = document.getElementById('messageHeader');
  header2.innerHTML = message;

  // remove updateStatusDiv after 3 seconds
  setTimeout(function(){
    div.style.opacity = "0";
    var newURL = location.pathname;
    window.history.replaceState('object', document.title, newURL); // removeQueryString from url without refreshing
    // location.replace("account.php");
  }, 2000);
}
