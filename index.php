<?php
ob_start();
$pageTitle = 'Home';
include('includes/templates/header.php');
?>

<!-- Hero Section Begin -->
<section class="hero-section">
  <div class="hero-items owl-carousel">
    <div class="single-hero-items set-bg" data-setbg="layout/img/hero-1.jpg">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <span>Consoles</span>
            <h1>Black friday</h1>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
              do eiusmod tempor incididunt ut labore et dolore
            </p>
            <a href="#" class="primary-btn">Shop Now</a>
          </div>
        </div>
        <div class="off-card">
          <h2>Sale <span>50%</span></h2>
        </div>
      </div>
    </div>
    <div class="single-hero-items set-bg" data-setbg="layout/img/hero-2.jpg">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <span>VR Headsets</span>
            <h1>Black friday</h1>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
              do eiusmod tempor incididunt ut labore et dolore
            </p>
            <a href="#" class="primary-btn">Shop Now</a>
          </div>
        </div>
        <div class="off-card">
          <h2>Sale <span>50%</span></h2>
        </div>
      </div>
    </div>
    <div class="single-hero-items set-bg" data-setbg="layout/img/hero-3.jpg">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <span>Computers</span>
            <h1>Black friday</h1>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
              do eiusmod tempor incididunt ut labore et dolore
            </p>
            <a href="#" class="primary-btn">Shop Now</a>
          </div>
        </div>
        <div class="off-card">
          <h2>Sale <span>50%</span></h2>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<div class="banner-section spad">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4">
        <div class="single-banner">
          <img src="layout/img/banner-1.jpg" alt="" />
          <div class="inner-text">
            <h4>Desktops</h4>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="single-banner">
          <img src="layout/img/banner-2.jpg" alt="" />
          <div class="inner-text">
            <h4>Laptops</h4>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="single-banner">
          <img src="layout/img/banner-3.png" alt="" />
          <div class="inner-text">
            <h4>Accessories</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Banner Section End -->

<!-- Top Sale Section Begin -->
<?php include('includes/templates/_top-sale.php'); ?>
<!-- Top Sale Section End -->

<!-- Deal Of The Week Section Begin-->
<section class="deal-of-week set-bg spad" data-setbg="layout/img/time-bg.jpg">
  <div class="container">
    <div class="col-lg-6 text-center">
      <div class="section-title">
        <h2>Deal Of The Week</h2>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed<br />
          do ipsum dolor sit amet, consectetur adipisicing elit
        </p>
        <div class="product-price">
          $35.00
          <span>/ HanBag</span>
        </div>
      </div>
      <div class="countdown-timer" id="countdown">
        <div class="cd-item">
          <span>56</span>
          <p>Days</p>
        </div>
        <div class="cd-item">
          <span>12</span>
          <p>Hrs</p>
        </div>
        <div class="cd-item">
          <span>40</span>
          <p>Mins</p>
        </div>
        <div class="cd-item">
          <span>52</span>
          <p>Secs</p>
        </div>
      </div>
      <a href="shop.php" class="primary-btn">Shop Now</a>
    </div>
  </div>
</section>
<!-- Deal Of The Week Section End -->

<!-- Featured Section Begin -->
<?php include('includes/templates/_featured.php'); ?>
<!-- Featured Section End -->

<!-- New Products Section Begin -->
<?php include('includes/templates/_new-products.php'); ?>
<!-- New Products Section End -->

<!-- Instagram Section Begin -->
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin -->
<?php include('includes/templates/benefit.php'); ?>
<!-- Latest Blog Section End -->

<?php
include('includes/templates/footer.php');
ob_end_flush();
?>