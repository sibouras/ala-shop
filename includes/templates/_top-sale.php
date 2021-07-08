<?php
$products = $product->getData(
  "SELECT items.*,
    categories.name AS category_name
  FROM items
    INNER JOIN categories ON categories.id = items.category_id LIMIT 12;
  "
);
shuffle($products);

if (isset($_SESSION['userId'])) {
  $cartIds = $cart->getCartIds($product->getData("SELECT * FROM cart WHERE user_id=$_SESSION[userId]"));
} else {
  $cartIds = array_keys($_SESSION['cart']);
}
?>

<!-- Top Sale Section Begin -->
<section class="women-banner spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2>Top Sale</h2>
        </div>
        <div class="new-products-slider owl-carousel">
          <?php foreach ($products as $item) : ?>
            <div class="product-item">
              <div class="pi-pic">
                <a href="product.php?item_id=<?= $item['id']; ?>">
                  <img src="uploads/itemImages/<?= $item['image']; ?>" alt="" />
                </a>
                <div class="sale">Sale</div>
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
                <div class="product-price">
                  $<?= number_format($item['price'], 2); ?>
                  <span>
                    <?php
                    $price = (float) $item['price'];
                    $result = $price + ($price * 30 / 100);
                    echo '&' . number_format($result, 2);
                    ?>
                  </span>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Top Sale Section End -->