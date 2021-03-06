<?php
if (!isset($_SESSION)) {
  session_start();
}
require('includes/functions/functions.php');
$categories = $product->getData(
  "SELECT name FROM categories"
);
if (is_array($user->checkLogin())) {
  $userData = $user->checkLogin();
} else if (isset($_SESSION['userId'])) {
  // if user is deleted from db logout
  header('Location: logout.php');
}

if (empty($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}
$cart->insertCartSession();

$cartCount = $cart->countItems();
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>AlaShop | <?= getTitle(); ?></title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

  <!-- Css Styles -->
  <link rel="stylesheet" href="layout/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="layout/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="layout/css/themify-icons.css" type="text/css" />
  <link rel="stylesheet" href="layout/css/elegant-icons.css" type="text/css" />
  <link rel="stylesheet" href="layout/css/owl.carousel.min.css" type="text/css" />
  <link rel="stylesheet" href="layout/css/nice-select.css" type="text/css" />
  <link rel="stylesheet" href="layout/css/jquery-ui.min.css" type="text/css" />
  <link rel="stylesheet" href="layout/css/slicknav.min.css" type="text/css" />
  <link rel="stylesheet" href="layout/css/style.css" type="text/css" />
  <link rel="stylesheet" href="layout/css/custom.css" type="text/css" />
</head>

<body>
  <!-- Page Preloder -->
  <!-- <div id="preloder">
    <div class="loader"></div>
  </div> -->

  <!-- Header Section Begin -->
  <header class="header-section">
    <div class="header-top">
      <div class="container">
        <div class="ht-left">
          <div class="mail-service">
            <i class="fa fa-envelope"></i>
            alashop@gmail.com
          </div>
          <div class="phone-service">
            <i class="fa fa-phone"></i>
            +65 11.188.888
          </div>
        </div>
        <div class="ht-right">
          <?php if (isset($userData)) : ?>
            <div id="user-dropdown" class="login-panel">
              <div class="profile" onclick="menuToggle();">
                <img src="uploads/profileImages/<?= $userData['image']; ?>" alt="">
              </div>
              <div class="menu">
                <h5><?= $userData['userName']; ?></h5>
                <ul>
                  <?php if ($userData['groupID'] == 1) : ?>
                    <li>
                      <a href="admin/dashboard.php"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a>
                    </li>
                  <?php endif; ?>
                  <li>
                    <a href="profile.php"><i class="fa fa-user-o" aria-hidden="true"></i>My Profile</a>
                  </li>
                  <li>
                    <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
                  </li>
                </ul>
              </div>
            </div>
          <?php else : ?>
            <a href="login.php" class="login-panel"><i class="fa fa-user"></i>Login</a>
          <?php endif; ?>
          <div class="lan-selector">
            <select class="language_drop" name="countries" id="countries" style="width: 300px">
              <option value="yt" data-image="layout/img/flag-1.jpg" data-imagecss="flag yt" data-title="English">
                English
              </option>
              <option value="yu" data-image="layout/img/flag-2.jpg" data-imagecss="flag yu" data-title="Bangladesh">
                German
              </option>
            </select>
          </div>
          <div class="top-social">
            <a href="#"><i class="ti-facebook"></i></a>
            <a href="#"><i class="ti-twitter-alt"></i></a>
            <a href="#"><i class="ti-linkedin"></i></a>
            <a href="#"><i class="ti-pinterest"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="inner-header">
        <div class="row">
          <div class="col-lg-2 col-md-2">
            <div class="logo">
              <a href="./index.php">
                <img src="layout/img/ala-shop-3.png" alt="" />
              </a>
            </div>
          </div>
          <div class="col-lg-7 col-md-7">
            <div class="advanced-search">
              <div class="nice-select" tabindex="0"><span class="current">All Categories</span>
                <ul class="list">
                  <li data-value="" class="option focus selected">All Categories</li>
                  <?php foreach ($categories as $cat) : ?>
                    <li class="option focus"><?= $cat['name']; ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
              <div class="input-group">
                <input type="text" placeholder="What do you need?" />
                <button type="button"><i class="ti-search"></i></button>
                <div id="search-result"> </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 text-right col-md-3">
            <ul class="nav-right">
              <li class="heart-icon">
                <a href="#">
                  <i class="icon_heart_alt"></i>
                  <span>0</span>
                </a>
              </li>
              <li class="cart-icon">
                <a href="shopping-cart.php">
                  <i class="icon_bag_alt"></i>
                  <span><?= $cartCount ?? 0; ?></span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="nav-item">
      <div class="container">
        <div class="nav-depart">
          <div class="depart-btn">
            <i class="ti-menu"></i>
            <span>All departments</span>
            <ul class="depart-hover">
              <?php foreach ($categories as $cat) : ?>
                <li><a href="shop.php?category=<?= $cat['name']; ?>"><?= $cat['name']; ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <nav class="nav-menu mobile-menu">
          <ul>
            <li class="<?= active('index.php'); ?>"><a href="./index.php">Home</a></li>
            <li class="<?= active('shop.php'); ?>"><a href="./shop.php">Shop</a></li>
            <li class="<?= active('shopping-cart.php'); ?>"><a href="./shopping-cart.php">Cart</a></li>
            <li class="<?= active('contact.php'); ?>"><a href="./contact.php">Contact</a></li>
            <li class="<?= active('faq.php'); ?>"><a href="./faq.php">FAQ</a></li>
          </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
      </div>
    </div>
  </header>
  <!-- Header End -->