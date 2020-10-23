var unfavBtn; var favBtn; var removeCartBtn; var addCartBtn;

function getVariables( productid ){
  unfavBtn = document.getElementById('unfavBtn' + productid);
  favBtn = document.getElementById('favBtn' + productid);
  removeCartBtn = document.getElementById('removeCartBtn' + productid);
  addCartBtn = document.getElementById('addCartBtn' + productid);
}

function checkUser(userid){
  if(userid > 0){
    return true;
  }
  else {
    setUpdateStatusDiv( 2, "Login to like and add products" );
    return false;
  }
}

function favouriteProduct( productid, userid ){
  if(checkUser(userid)){
    getVariables(productid);
    this.unfavBtn.style.display = "none";
    this.favBtn.style.display = "block";
    // call php > add to rating_randa
  }
}

function unfavouriteProduct( productid, userid ){
  if(checkUser(userid)){
    getVariables(productid);
    this.favBtn.style.display = "none";
    this.unfavBtn.style.display = "block";
    // call php > remove from rating_randa
  }
}

function addProduct( productid, userid ){
  if(checkUser(userid)){
    getVariables(productid);
    addCartBtn.style.display = "none";
    removeCartBtn.style.display = "block";
    // call php > add to cart_randa
  }
}

function removeProduct( productid, userid ){
  if(checkUser(userid)){
    getVariables(productid);
    removeCartBtn.style.display = "none";
    addCartBtn.style.display = "block";
    // call php > add to cart_randa
  }
}
