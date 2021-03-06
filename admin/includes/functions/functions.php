<?php

// Title function that echos the page title if the page has the variable $pageTitle else echo default
function getTitle()
{
  global $pageTitle;
  if (isset($pageTitle)) {
    echo $pageTitle;
  } else {
    echo 'default';
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

// Function to check if item exists in database
function checkItem($select, $from, $value)
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT $select FROM $from WHERE $select = ?");
  $stmt->execute([$value]);
  return $stmt->rowCount();
}

// Count number of items 
// $item = the item to count
function countItems($item, $table)
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT COUNT($item) FROM $table");
  $stmt->execute();
  return $stmt->fetchColumn();
}

// Count last 10 day's records
function countNewItems($item, $table, $date)
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT COUNT($item) FROM $table WHERE $date >= DATE_SUB(CURDATE(), INTERVAL 10 DAY)");
  $stmt->execute();
  return $stmt->fetchColumn();
}

// Get latest records
function getLatest($select, $table, $order, $limit = 5)
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
  $stmt->execute();
  return $stmt->fetchAll();
}

function margin($value)
{
  echo "<div style='
             padding-left:250px;
             margin-top: 65px;
      '>$value</div>";
}


function pre_r($value)
{
  echo "<pre style='
             padding-left:250px;
             margin-top: 65px;
      '>";
  print_r($value);
  echo "</pre>";
}
