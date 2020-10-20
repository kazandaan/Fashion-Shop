function getVariables(){
  var username = document.forms["accountForm"]["username"];
  var name = document.forms["accountForm"]["name"];
  var email = document.forms["accountForm"]["email"];
  var phone = document.forms["accountForm"]["phone"];
  var birthday = document.forms["accountForm"]["birthday"];
  var address = document.forms["accountForm"]["address"];
  var cardno = document.forms["accountForm"]["cardno"];
  var cardname = document.forms["accountForm"]["cardname"];
  var type = document.forms["accountForm"]["card"];

  var array = [username, name, email, phone, birthday, address, cardno, cardname, card];
  return array;
}
function editDetails(){
  var editmode = document.getElementById('editMode');
  editmode.style.display = "block";

  var editBtn = document.getElementById('editDetailsBtn');
  editBtn.style.display = "none";

  var array = getVariables();
  // Show Inputbox
  array.forEach((item, i) => {
    item.style.border = "2px solid black";
    item.removeAttribute("disabled");
  });
}

function cancelEdit(){
  var editmode = document.getElementById('editMode');
  editmode.style.display = "none";

  var editBtn = document.getElementById('editDetailsBtn');
  editBtn.style.display = "block";

  //reset Inputbox values to original

  var array = getVariables();
  // Hide Inputbox
  array.forEach((item, i) => {
    item.style.border = "0px solid white";
    item.setAttribute("disabled", true);
  });
}

var modal = document.getElementById('passwordModal');
function openModal(){
  modal.style.display = "block";
}
function closeModal(){
  modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
