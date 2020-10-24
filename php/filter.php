<?php

  // + Search Filter
  if( isset($_POST['searchbox']) && $_POST['searchbox'] != "" ){
    $search = $_POST['searchbox'];
    $sql = addFilter($filter, "product_name", "%$search%");
    $title = "Search '$search'";
    $msg = "There are no products that match '$search'";
  }
  // + Price Filter
  else if( isset($_GET['min']) && isset($_GET['max']) ){
    $min = $_GET['min'];
    $max = $_GET['max'];
    $sql = addPriceFilter($filter, $min, $max);
    $title = "Price '$$min to $$max'";
    $msg = "There are no products that are within the range of '$min' and '$max'";
  }
  // + Type Filter
  else if( isset($_GET['type']) ){
    $type = $_GET['type'];
    $sql = addFilter($filter, "product_type", $type);
    $title = "Type '$type'";
    $msg = "There are no products that are of type '$type'";
  }
  // + Brand Filter
  else if( isset($_GET['brand']) ){
    $brand = $_GET['brand'];
    $sql = addFilter($filter, "product_brand", $brand);
    $title = "Brand '$brand'";
    $msg = "There are no products that are of '$brand' brand";
  }

?>
