var modal;
function openModal(modalname, closemodal){
  this.modal = document.getElementById(modalname);
  modal.style.display = "block";
  closeModal(closemodal);
}
function closeModal(modalname){
  var close = document.getElementById(modalname);
  close.style.display = "none";
  resetForm();
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    resetForm();
  }
}

function resetForm(){
  document.getElementById('loginForm').reset();
  document.getElementById('registerForm').reset();
}
