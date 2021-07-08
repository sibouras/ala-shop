<?php
$newProducts = $product->getNewData(
  "SELECT items.*,
    categories.name AS category_name
  FROM items
    INNER JOIN categories ON categories.id = items.category_id
  ",
  10
);
shuffle($newProducts);

if (!isset($cartIds)) {
  if (isset($_SESSION['userId'])) {
    $cartIds = $cart->getCartIds($product->getData("SELECT * FROM cart WHERE user_id=$_SESSION[userId]"));
  } else {
    $cartIds = array_keys($_SESSION['cart']);
  }
}
?>

<!-- New Products Section Begin -->
<section class="new-products-banner">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2>New Products</h2>
        </div>
        <div class="new-products-slider owl-carousel">
          <?php foreach ($newProducts as $item) : ?>
            <div class="product-item">
              <div class="pi-pic">
                <a href="product.php?item_id=<?= $item['id']; ?>">
                  <img src="uploads/itemImages/<?= $item['image']; ?>" alt="" />
                </a>
                <div class="icon">
                  <i class="icon_heart_alt"></i>
                </div>
                <ul>
                  <li class="w-icon active">
                    <?php if (in_array($item['id'], $cartIds)) : ?>
                      <button class="icon_bag_green" disabled><i class="icon_bag_alt"></i></button>
                    <?php else : ?>
                      <button type="button" class="bag-icon" data-itemid="<?= $item['id']; ?>" data-userid="<?= $_SESSION['userId'] ?? ''; ?>"><i class="icon_bag_alt"></i></button>
                    <?php endif; ?>
                  </li>
                  <li class="quick-view"><a href="#">+ Quick View</a></li>
                  <li class="w-icon">
                    <a href="#"><i class="fa fa-random"></i></a>
                  </li>
                </ul>
              </div>
              <div class="pi-text">
                <div class="catagory-name"><?= $item['category_name']; ?></div>
                <a href="product.php?item_id=<?= $item['id']; ?>">
                  <h5><?= $item['name']; ?></h5>
                </a>
                <div class="product-price">$<?= number_format($item['price'], 2); ?></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- New Products Section End -->