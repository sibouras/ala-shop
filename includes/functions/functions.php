<?php

// require MySQL Connection
require('admin/connect.php');

// require Product class
require('database/Product.php');

// require Cart class
require('database/Cart.php');

// require User class
require('database/User.php');

// product object
$product = new Product($pdo);

// cart object
$cart = new Cart($pdo);

// user object
$user = new User($pdo);


function pre_r($value)
{
  echo "<pre>";
  print_r($value);
  echo "</pre>";
}
