<?php

include 'connect.php';

// Routes
$tpl = 'includes/templates'; // Template Directory
$lang = 'includes/languages'; // Language Directory
$func = 'includes/functions';
$css = 'layout/css'; // Css Directory
$img = 'layout/img'; // Img Directory
$js = 'layout/js'; // Css Directory

// Include the important files
include "$func/functions.php";
include "$lang/english.php";
include "$tpl/header.php";

if (isset($sidebar)) {
  include "$tpl/sidebar.php";
}

if (!isset($noNavbar)) {
  include "$tpl/navbar.php";
}
