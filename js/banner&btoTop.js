var mybutton = document.getElementById("myBtn");
window.onscroll = function(){scrollFunction()};
var asd = document.getElementById('banner');

// Banner smooth animation
function scrollFunction() {
  if(document.body.scrollTop > 20 ||document.documentElement.scrollTop > 20){
    asd.style.opacity = "0";
    asd.style.height = "0px";
    mybutton.style.display = "block";
  }
  else {
    asd.style.opacity = "1";
    asd.style.height = "50px";
    mybutton.style.display = "none";
  }
}

// Back to top
function topFunction() {
document.body.scrollTop = 0;
document.documentElement.scrollTop = 0;
}
