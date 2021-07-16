<?php
ob_start();
$pageTitle = 'Order';
include('includes/templates/header.php');

if (isset($_POST['submit'])) {
  $order->placeOrder();
  $cart->emptyCart();
  header("Location: $_SERVER[PHP_SELF]");
}
?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-text product-more">
          <a href="./index.php"><i class="fa fa-home"></i> Home</a>
          <a href="./shop.php">Shop</a>
          <span>Order</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Section Begin -->


<section class="spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <div class="placeorder content-wrapper">
          <h3 class="mb-3">Your Order Has Been Placed</h3>
          <h5>Thank you for ordering with us, we'll contact you by email with your order details.</h5>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('includes/templates/footer.php');
ob_end_flush();
?>