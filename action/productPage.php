<?php
/*
  DEFAULT, SEARCH NULL > [else]
    products.php... > all products, search = null
  SEARCH > input from nav
    ?search=value > LIKE %value%
  WOMEN, MEN, KIDS >
    ?category=value > women, men, kids
  WOMEN, MEN, KIDS + SEARCH > input from let column
    ?category=value&search=value
  WOMEN, MEN, KIDS + FILTER >
    ?category=value&filter=value
*/
  if( isset($_GET['category']) ){
    // Category (alone)
    $category = $_GET['category'];
    $sql = "SELECT * FROM product_randa WHERE product_category = '$category'";
    $title = $category;
    $msg = "There are no products in $category's category.";

    // + Search Filter
    if( isset($_POST['searchbox']) ){
      $search = $_POST['searchbox'];
      $sql = addFilter("$sql AND", "product_name", "%$search%");
      $title = "$category '$search'";
      $msg = "There are no products that match '$search' in $category's category.";
    }
    // + Price Filter
    else if( isset($_GET['min']) && isset($_GET['max']) ){
      $min = $_GET['min'];
      $max = $_GET['max'];
      $sql = addPriceFilter("$sql AND", $min, $max);
      $title = "$category '$$min to $$max'";
      $msg = "There are no products that are within the range of '$min' and '$max' in $category's category.";
    }
    // + Type Filter
    else if( isset($_GET['type']) ){
      $type = $_GET['type'];
      $sql = addFilter("$sql AND", "product_type", $type);
      $title = "$category '$type'";
      $msg = "There are no products that are of type '$type' in $category's category.";
    }
    // + Brand Filter
    else if( isset($_GET['brand']) ){
      $brand = $_GET['brand'];
      $sql = addFilter("$sql AND", "product_brand", $brand);
      $title = "$category '$brand'";
      $msg = "There are no products that are of '$brand' brand in $category's category.";
    }
  }
  // favourites and cart page
  else if( isset($_GET['page']) ){

    // not authorized
    if( !isset($id) ){
      header("Location:index.php?page=unauthorized&status=2");
    }

    $page = $_GET['page'];
    if( $page == "favourites"){
      $sql = "SELECT * FROM product_randa
      JOIN rating_randa ON product_randa.product_id = rating_randa.product_id
      WHERE user_id = $id AND rating_favourite = 1";
      $title = "Your Favourites";
      $msg = "You have not liked any products.";
    }
    else
    if( $page == "cart" ){
      $sql = "SELECT * FROM product_randa
      JOIN cart_randa ON product_randa.product_id = cart_randa.product_id
      WHERE user_id = $id";
      $title = "Your Shopping Cart";
      $msg = "You have not added any products to cart.";
    }
  }
  else{
    // all products (alone) [not categorized]
    $sql = "SELECT * FROM product_randa";
    $title = "All Products";
    $msg = "There are no products.";

    // + Search Filter
    if( isset($_POST['searchbox']) && $_POST['searchbox'] != "" ){
      $search = $_POST['searchbox'];
      $sql = addFilter("$sql WHERE", "product_name", "%$search%");
      $title = "All Products '$search'";
      $msg = "There are no products that match '$search' in $category's category.";
    }
    // + Price Filter
    else if( isset($_GET['min']) && isset($_GET['max']) ){
      $min = $_GET['min'];
      $max = $_GET['max'];
      $sql = addPriceFilter("$sql WHERE", $min, $max);
      $title = "All Products '$$min to $$max'";
      $msg = "There are no products that are within the range of '$min' and '$max' in $category's category.";
    }
    // + Type Filter
    else if( isset($_GET['type']) ){
      $type = $_GET['type'];
      $sql = addFilter("$sql WHERE", "product_type", $type);
      $title = "All Products '$type'";
      $msg = "There are no products that are of type '$type' in $category's category.";
    }
    // + Brand Filter
    else if( isset($_GET['brand']) ){
      $brand = $_GET['brand'];
      $sql = addFilter("$sql WHERE", "product_brand", $brand);
      $title = "All Products '$brand'";
      $msg = "There are no products that are of '$brand' brand in $category's category.";
    }
  }

  // search, type, brand
  function addFilter( $sql, $column, $value){
    $sql .= " $column LIKE '$value' ORDER BY product_name ASC";
    if($column != "product_name"){
      setURL();
    }
    return $sql;
  }
  function addPriceFilter( $sql, $min, $max){
    $sql .= " product_price BETWEEN $min AND $max ORDER BY product_price ASC";
    setURL();
    return $sql;
  }
  function setURL(){ // after filter
    echo "window.history.replaceState('object', document.title, document.referrer);";
  }
?>
