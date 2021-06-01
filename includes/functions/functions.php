<?php

// require MySQL Connection
require('admin/connect.php');

// require Product Class
require('database/Product.php');

$product = new Product($pdo);

function pre_r($value)
{
  echo "<pre>";
  print_r($value);
  echo "</pre>";
}
