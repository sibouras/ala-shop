<?php include('includes/templates/header.php');

$cartItems = $product->getData(
  "SELECT items.id, items.name, items.price, user_id, quantity FROM items
    INNER JOIN cart ON cart.item_id = items.id AND cart.user_id = $_SESSION[userId]"
);
?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-text product-more">
          <a href="./index.php"><i class="fa fa-home"></i> Home</a>
          <a href="./shop.php">Shop</a>
          <span>Check Out</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="checkout-section spad">
  <div class="container">
    <form action="order.php" class="checkout-form" method="POST">
      <div class="row">
        <div class="col-lg-6">
          <div class="checkout-content">
            <a href="#" class="content-btn">Click Here To Login</a>
          </div>
          <h4>Billing Details</h4>
          <div class="row">
            <div class="col-lg-6">
              <label for="first">First Name<span>*</span></label>
              <input type="text" id="first" name="first" required>
            </div>
            <div class="col-lg-6">
              <label for="last">Last Name<span>*</span></label>
              <input type="text" id="last" name="last" required>
            </div>
            <div class="col-lg-12">
              <label for="country">Country<span>*</span></label>
              <input type="text" id="country" name="country">
            </div>
            <div class="col-lg-12">
              <label for="address">Street Address<span>*</span></label>
              <input type="text" id="address" name="address" class="street-first">
            </div>
            <div class="col-lg-12">
              <label for="zip">Postcode / ZIP (optional)</label>
              <input type="text" id="zip" name="zip">
            </div>
            <div class="col-lg-12">
              <label for="city">Town / City<span>*</span></label>
              <input type="text" id="city" name="city">
            </div>
            <div class="col-lg-6">
              <label for="email">Email Address<span>*</span></label>
              <input type="text" id="email" name="email">
            </div>
            <div class="col-lg-6">
              <label for="phone">Phone<span>*</span></label>
              <input type="text" id="phone" name="phone">
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="checkout-content">
            <input type="text" placeholder="Enter Your Coupon Code">
          </div>
          <div class="place-order">
            <h4>Your Order</h4>
            <div class="order-total">
              <ul class="order-table">
                <li>Product <span>Total</span></li>
                <?php foreach ($cartItems as $item) : ?>
                  <li class="fw-normal"><?php echo "$item[name] x $item[quantity]"; ?><span>$<?= $cart->getTotal($item['price'], $item['quantity']); ?></span></li>
                <?php $subTotal[] = $cart->getTotal($item['price'], $item['quantity']);
                endforeach; ?>
                <li class="fw-normal">Subtotal <span>$<?= isset($subTotal) ? $cart->getSum($subTotal) : 0; ?></span></li>
                <li class="total-price">Total <span>$<?= isset($subTotal) ? $cart->getSum($subTotal) : 0; ?></span></li>
                <input type="hidden" name="total" value="<?= isset($subTotal) ? $cart->getSum($subTotal) : 0; ?>">
              </ul>
              <div class="payment-check">
                <div class="pc-item">
                  <label for="pc-check">
                    Cheque Payment
                    <input type="checkbox" id="pc-check">
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="pc-item">
                  <label for="pc-paypal">
                    Paypal
                    <input type="checkbox" id="pc-paypal">
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="order-btn">
                <button type="submit" name="submit" class="site-btn place-btn">Place Order</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
<!-- Shopping Cart Section End -->

<?php include('includes/templates/footer.php'); ?>