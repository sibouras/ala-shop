<?php

require('admin/connect.php');
require('database/Product.php');
require('database/Cart.php');
require('database/User.php');
require('database/Order.php');

$product = new Product($pdo);
$cart = new Cart($pdo);
$user = new User($pdo);
$order = new Order($pdo);


function pre_r($value)
{
  echo "<pre>";
  print_r($value);
  echo "</pre>";
}

// Function to check if item exists in database
function checkItem($select, $from, $value)
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT $select FROM $from WHERE $select = ?");
  $stmt->execute([$value]);
  return $stmt->rowCount();
}
