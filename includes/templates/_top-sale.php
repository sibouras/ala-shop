<?php
$products = $product->getData(
  "SELECT items.*,
    categories.name AS category_name
  FROM items
    INNER JOIN categories ON categories.id = items.category_id;
  "
);
shuffle($products);
?>
<!-- Top Sale Section Begin -->
<section class="women-banner spad">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3">
        <div class="product-large set-bg" data-setbg="layout/img/products/women-large.jpg">
          <h2>Women’s</h2>
          <a href="#">Discover More</a>
        </div>
      </div>
      <div class="col-lg-8 offset-lg-1">
        <div class="section-title">
          <h2>Top Sale</h2>
        </div>
        <div class="product-slider owl-carousel">
          <?php foreach ($products as $item) : ?>
            <div class="product-item">
              <div class="pi-pic">
                <a href="product.html">
                  <img src="uploads/itemImages/<?= $item['image']; ?>" alt="" />
                </a>
                <div class="sale">Sale</div>
                <div class="icon">
                  <i class="icon_heart_alt"></i>
                </div>
                <ul>
                  <li class="w-icon active">
                    <a href="#"><i class="icon_bag_alt"></i></a>
                  </li>
                  <li class="quick-view"><a href="#">+ Quick View</a></li>
                  <li class="w-icon">
                    <a href="#"><i class="fa fa-random"></i></a>
                  </li>
                </ul>
              </div>
              <div class="pi-text">
                <div class="catagory-name"><?= $item['category_name']; ?></div>
                <a href="#">
                  <h5><?= $item['name']; ?></h5>
                </a>
                <div class="product-price">
                  <?= $item['price']; ?>
                  <span>
                    <?php
                    preg_match('/(\d[\d.]*)/', $item['price'], $matches);
                    $price = $matches[0];
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