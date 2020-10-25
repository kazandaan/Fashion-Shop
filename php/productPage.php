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
  $checkout = "none";
  if( isset($_GET['category']) ){
    // Category (alone)
    $category = $_GET['category'];
    $sql = "SELECT * FROM product_randa WHERE product_category = '$category'";
    $title = $category;
    $msg = "There are no products";

    $filter = $sql . " AND"; //"$sql AND"
    include "php/filter.php";
    $msg .= " in $category's category";
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
      $msg = "You have not liked any products";

      $filter = $sql . " AND"; //"$sql AND"
      include "php/filter.php";
      $msg .= " in your favourites";
    }
    else
    if( $page == "cart" ){
      $sql = "SELECT * FROM product_randa
      JOIN cart_randa ON product_randa.product_id = cart_randa.product_id
      WHERE user_id = $id";
      $title = "Your Shopping Cart";
      $msg = "You have not added any products to cart";

      $filter = $sql . " AND"; //"$sql AND"
      include "php/filter.php";
      $msg .= " in your cart";

      $checkout = "block";
    }
  }
  else{
    // all products (alone) [not categorized]
    $sql = "SELECT * FROM product_randa";
    $title = "All Products";
    $msg = "There are no products.";

    $filter = $sql . " WHERE"; //"$sql WHERE"
    include "php/filter.php";
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
