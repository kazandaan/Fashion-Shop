var modal2;
function openModal(modalname, closemodal){
  this.modal2 = document.getElementById(modalname);
  modal2.style.display = "block";
  closeModal(closemodal);
}
function closeModal(modalname){
  var close2 = document.getElementById(modalname);
  close2.style.display = "none";
  resetForm();
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal2) {
    modal2.style.display = "none";
    resetForm();
  }
}

function resetForm(){
  document.getElementById('loginForm').reset();
  document.getElementById('registerForm').reset();
}
