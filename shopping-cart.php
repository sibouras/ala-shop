<?php
include('includes/templates/header.php');

if (isset($_SESSION['userId'])) {
  $cartItems = $product->getData(
    "SELECT items.*, user_id, quantity FROM items
    INNER JOIN cart ON cart.item_id = items.id AND cart.user_id = $_SESSION[userId]"
  );
} else if (!empty($_SESSION['cart'])) {
  $cartIds = array_keys($_SESSION['cart']);
  $whereIn = implode(',', $cartIds);
  $cartItems = $product->getData(
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
                <th class="empty-cart"><i class="ti-close"></i></th>
              </tr>
            </thead>
            <tbody id="table-body">
              <?php if (!isset($_SESSION['userId']) && empty($_SESSION['cart'])) : ?>
                <tr>
                  <th>Cart is empty!</th>
                </tr>
              <?php else : ?>
                <?php foreach ($cartItems as $item) : ?>
                  <tr>
                    <td class="cart-pic "><img src="uploads/itemImages/<?= $item['image']; ?>" alt=""></td>
                    <td class="cart-title ">
                      <h5 class="pl-3"><?= $item['name']; ?></h5>
                    </td>
                    <td class="p-price" data-id="<?= $item['id']; ?>" data-price="<?= $item['price']; ?>">$<?= number_format($item['price'], 2); ?></td>
                    <td class="qua-col ">
                      <div class="quantity">
                        <div class="pro-qty">
                          <input type="text" data-id="<?= $item['id']; ?>" value="<?= $item['quantity'] ?? $_SESSION['cart'][$item['id']]; ?>">
                        </div>
                      </div>
                    </td>
                    <td class="total-price" data-id="<?= $item['id']; ?>" data-total="<?php echo $item['price'] * ($item['quantity'] ?? $_SESSION['cart'][$item['id']]); ?>">$<?= $cart->getTotal($item['price'], ($item['quantity']) ?? $_SESSION['cart'][$item['id']]); ?></td>
                    <td class="close-td"><i class="ti-close delete-cart-item" data-id="<?= $item['id']; ?>"></i></td>
                  </tr>
              <?php $subTotal[] = $cart->getTotal($item['price'], ($item['quantity'] ?? $_SESSION['cart'][$item['id']]));
                endforeach;
              endif; ?>
            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="cart-buttons">
              <a href="shop.php" class="primary-btn continue-shop">Continue shopping</a>
              <button class="primary-btn empty-cart">Empty cart</button>
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
                <li class="subtotal">Subtotal <span data-subtotal="<?= isset($subTotal) ? $cart->getSum($subTotal) : 0; ?>">$<?= isset($subTotal) ? number_format($cart->getSum($subTotal), 2) : 0; ?></span></li>
                <li class="cart-total">Total <span>$<?= isset($subTotal) ? number_format($cart->getSum($subTotal), 2) : 0; ?></span></li>
              </ul>
              <?php if (isset($_SESSION['userId'])) : ?>
                <a href="checkout.php" class="proceed-btn">PROCEED TO CHECK OUT</a>
              <?php else : ?>
                <a href="login.php" class="proceed-btn">LOGIN TO CHECK OUT</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Shopping Cart Section End -->

<?php include('includes/templates/footer.php'); ?>