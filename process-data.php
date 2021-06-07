<?php
require('includes/functions/functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['register_submit'])) {
    $user->signup($_POST);
  }
}
