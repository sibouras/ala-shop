<?php

// require MySQL Connection
require('admin/connect.php');

// require Product class
require('database/Product.php');

// require Cart class
require('database/Cart.php');

// product object
$product = new Product($pdo);

// cart object
$cart = new Cart($pdo);

// $cart->insertIntoCart(3, 4);

function pre_r($value)
{
  echo "<pre>";
  print_r($value);
  echo "</pre>";
}
