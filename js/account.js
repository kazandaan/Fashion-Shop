function getVariables(){
  var username = document.forms["accountForm"]["username"];
  var name = document.forms["accountForm"]["name"];
  var email = document.forms["accountForm"]["email"];
  var phone = document.forms["accountForm"]["phone"];
  var birthday = document.forms["accountForm"]["birthday"];
  var address = document.forms["accountForm"]["address"];
  var cardno = document.forms["accountForm"]["cardno"];

  var array = [username, name, email, phone, birthday, address, cardno];
  return array;
}
function editDetails(){
  var editmode = document.getElementById('editMode');
  editmode.style.display = "block";

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

  //reset Inputbox values to original

  var array = getVariables();
  // Hide Inputbox
  array.forEach((item, i) => {
    item.style.border = "0px solid white";
    item.setAttribute("disabled", true);
  });
}

function resetValues(){

}
