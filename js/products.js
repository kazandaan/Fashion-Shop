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
    // call php > set rating_favourite = 1 in rating_randa
    location.replace("action/favouriteProduct.php?userid=" + userid + "&productid=" + productid + "&like=1");
  }
}

function unfavouriteProduct( productid, userid ){
  if(checkUser(userid)){
    getVariables(productid);
    this.favBtn.style.display = "none";
    this.unfavBtn.style.display = "block";
    // call php > set rating_favourite = 0 in rating_randa
    location.replace("action/favouriteProduct.php?userid=" + userid + "&productid=" + productid + "&like=0");
  }
}

function addProduct( productid, userid ){
  if(checkUser(userid)){
    getVariables(productid);
    addCartBtn.style.display = "none";
    removeCartBtn.style.display = "block";
    // call php > add to cart_randa
    location.replace("action/cartProduct.php?action=update&userid=" + userid + "&productid=" + productid + "&quantity=1");
  }
}

function removeProduct( productid, userid ){
  if(checkUser(userid)){
    getVariables(productid);
    removeCartBtn.style.display = "none";
    addCartBtn.style.display = "block";
    // call php > remove from cart_randa
    location.replace("action/cartProduct.php?action=delete&userid=" + userid + "&productid=" + productid );
  }
}

function checkPriceRange(){
  var priceRange = document.getElementById('priceRange').value;
  var min = priceRange;
  var max = parseInt(priceRange) + 50;
  if( min == 100 ){
    max = 500;
  }
  // window.history.replaceState('object', document.title, document.referrer);
  var url = getURL(location);
  location.replace(url + "min=" + min + "&max=" + max);
   // removeQueryString from url without refreshing
  // location.replace( location.pathname + "?min=" + min + "&max=" + max);
}

function checkType(){
  var type = document.getElementById('type').value;
  var url = getURL(location);
  location.replace(url + "type=" + type);
  // location.replace( location.pathname + "?type=" + type );
}

function checkBrand(){
  var brand = document.getElementById('brand').value;
  var url = getURL(location);
  location.replace(url + "brand=" + brand);
  // location.replace( location.pathname + "?brand=" + brand );
}

// GOT SOME BUG !! NEED TO DELETE PARAMS

function getURL( location ){ // add ? or &
  var url = location.pathname;
  if( location.search != "" ){
    url += location.search + "&";
  }
  else{
    url += "?";
  }
  return url;
}
