<?php
include('includes/templates/header.php');
if (isset($_SESSION['userId'])) {
  $cart = $product->getData(
    "SELECT items.*, user_id FROM items
    INNER JOIN cart ON cart.item_id = items.id AND cart.user_id = $_SESSION[userId]"
  );
} else if (!empty($_SESSION['cart'])) {
  $whereIn = implode(',', $_SESSION['cart']);
  $cart = $product->getData(
    "SELECT * FROM items WHERE id IN ($whereIn)"
  );
}
?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-text product-more">
          <a href="index.php"><i class="fa fa-home"></i> Home</a>
          <a href="shop.php">Shop</a>
          <span>Shopping Cart</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="cart-table">
          <table>
            <thead>
              <tr>
                <th>Image</th>
                <th class="p-name pl-3">Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th><i class="ti-close"></i></th>
              </tr>
            </thead>
            <tbody>
              <?php if (!isset($_SESSION['userId']) && empty($_SESSION['cart'])) : ?>
                <tr>
                  <th>Cart is empty!</th>
                </tr>
              <?php else : ?>
                <?php foreach ($cart as $item) : ?>
                  <tr>
                    <td class="cart-pic "><img src="uploads/itemImages/<?= $item['image']; ?>" alt=""></td>
                    <td class="cart-title ">
                      <h5 class="pl-3"><?= $item['name']; ?></h5>
                    </td>
                    <td class="p-price "><?= $item['price']; ?></td>
                    <td class="qua-col ">
                      <div class="quantity">
                        <div class="pro-qty">
                          <input type="text" value="1">
                        </div>
                      </div>
                    </td>
                    <td class="total-price ">$60.00</td>
                    <td class="close-td "><i class="ti-close"></i></td>
                  </tr>
              <?php endforeach;
              endif; ?>
            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="cart-buttons">
              <a href="#" class="primary-btn continue-shop">Continue shopping</a>
              <a href="#" class="primary-btn up-cart">Update cart</a>
            </div>
            <div class="discount-coupon">
              <h6>Discount Codes</h6>
              <form action="#" class="coupon-form">
                <input type="text" placeholder="Enter your codes">
                <button type="submit" class="site-btn coupon-btn">Apply</button>
              </form>
            </div>
          </div>
          <div class="col-lg-4 offset-lg-4">
            <div class="proceed-checkout">
              <ul>
                <li class="subtotal">Subtotal <span>$240.00</span></li>
                <li class="cart-total">Total <span>$240.00</span></li>
              </ul>
              <a href="#" class="proceed-btn">PROCEED TO CHECK OUT</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Shopping Cart Section End -->

<?php include('includes/templates/footer.php'); ?>