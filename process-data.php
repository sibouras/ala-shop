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
}
