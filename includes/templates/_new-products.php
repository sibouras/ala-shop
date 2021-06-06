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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['new-products_submit'])) {
    $cart->insertIntoCart($_POST['user_id'], $_POST['item_id']);
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
                    <form method="POST">
                      <input type="hidden" name="user_id" value="<?= 1; ?>">
                      <input type="hidden" name="item_id" value="<?= $item['id'] ?? ''; ?>">
                      <button type="submit" name="new-products_submit"><i class="icon_bag_alt"></i></button>
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
                <div class="product-price"><?= $item['price']; ?></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- New Products Section End -->