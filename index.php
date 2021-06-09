<?php
ob_start();
include('includes/templates/header.php');
print_r($_SESSION);
?>

<!-- Hero Section Begin -->
<section class="hero-section">
  <div class="hero-items owl-carousel">
    <div class="single-hero-items set-bg" data-setbg="layout/img/hero-1.jpg">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <span>Bag,kids</span>
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
            <span>Bag,kids</span>
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
            <h4>Men’s</h4>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="single-banner">
          <img src="layout/img/banner-2.jpg" alt="" />
          <div class="inner-text">
            <h4>Women’s</h4>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="single-banner">
          <img src="layout/img/banner-3.jpg" alt="" />
          <div class="inner-text">
            <h4>Kid’s</h4>
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
      <a href="#" class="primary-btn">Shop Now</a>
    </div>
  </div>
</section>
<!-- Deal Of The Week Section End -->

<!-- Featured Section Begin -->
<?php include('includes/templates/_featured.php'); ?>
<!-- Featured Section End -->

<!-- Ads Banner Begin -->
<div class="banner my-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="banner__pic">
          <img src="layout/img/banner/banner-1.jpg" alt="" />
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="banner__pic">
          <img src="layout/img/banner/banner-2.jpg" alt="" />
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Ads Banner End -->

<!-- New Products Section Begin -->
<?php include('includes/templates/_new-products.php'); ?>
<!-- New Products Section End -->

<!-- Instagram Section Begin -->
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin -->
<?php include('includes/templates/_blog.php'); ?>
<!-- Latest Blog Section End -->

<?php
include('includes/templates/footer.php');
ob_end_flush();
?>