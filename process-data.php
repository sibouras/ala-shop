<?php
require('includes/functions/functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['register_submit'])) {
    $user->register($_POST);
  }

  if (isset($_POST['login_submit'])) {
    $user->login($_POST);
  }
}