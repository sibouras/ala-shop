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

// Title function that echos the page title if the page has the variable $pageTitle else echo default
function getTitle()
{
  global $pageTitle;
  if (isset($pageTitle)) {
    echo $pageTitle;
  } else {
    echo 'Default';
  }
}

// Add active class to current page
function active($current_page)
{
  $url_array =  explode('/', $_SERVER['REQUEST_URI']);
  $url = end($url_array);
  // if ($currect_page == $url) {
  if (str_contains($url, $current_page)) {
    echo 'active'; //class name in css 
  } else {
    echo '';
  }
}
