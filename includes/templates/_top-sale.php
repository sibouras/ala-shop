<?php
$products = $product->getData(
  "SELECT items.*,
    categories.name AS category_name
  FROM items
    INNER JOIN categories ON categories.id = items.category_id LIMIT 10;
  "
);
shuffle($products);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['top-sale_submit'])) {
    $cart->insertIntoCart($_POST['user_id'], $_POST['item_id']);
  }
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
                    <form method="POST">
                      <input type="hidden" name="user_id" value="<?= 1; ?>">
                      <input type="hidden" name="item_id" value="<?= $item['id'] ?? ''; ?>">
                      <button type="submit" name="top-sale_submit"><i class="icon_bag_alt"></i></button>
                    </form>
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
                  <?= $item['price']; ?>
                  <span>
                    <?php
                    $price = (float) filter_var($item['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    echo '&' . $price + ($price * 30 / 100);
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