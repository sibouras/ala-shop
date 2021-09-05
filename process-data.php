<?php
if (!isset($_SESSION)) {
  session_start();
}
require('includes/functions/functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['register_submit'])) {
    $user->register($_POST);
  }

  if (isset($_POST['login_submit'])) {
    $user->login($_POST);
  }

  if (isset($_POST['profile_submit'])) {
    // $_POST as parameter not needed
    $user->updateProfile();
  }

  if (isset($_POST['qty'])) {
    $cart->update();
  }

  if (isset($_POST['deleteCartItem'])) {
    $cart->deleteCartItem();
  }

  if (isset($_POST['emptyCart'])) {
    $cart->emptyCart();
  }

  if (isset($_POST['bag'])) {
    $cart->insertIntoCart();
  }

  if (isset($_POST['term'])) {
    // remove special characters
    $term = preg_replace('/[^A-Za-z0-9- ]/', '', $_POST['term']);
    $term = "%$term%";

    $query = $_POST['category'] != 'All Categories' ?  "AND categories.name = '$_POST[category]'" : '';
    $stmt = $pdo->prepare(
      "SELECT items.*,
        categories.name AS category_name
      FROM items
        INNER JOIN categories ON categories.id = items.category_id
      WHERE items.name LIKE ? $query LIMIT 8;
      "
    );
    $stmt->execute([$term]);
    $result = $stmt->fetchAll();
    echo json_encode($result);
  }
}
