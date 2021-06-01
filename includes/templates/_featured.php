<?php
shuffle($products);
$categories = array_map(function ($product) {
  return $product['category_name'];
}, $products);
$categories = array_unique($categories);
sort($categories);
?>
<!-- Featured Section Begin -->
<section class="featured spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2>Featured Products</h2>
        </div>
        <div class="featured__controls">
          <ul>
            <li class="active" data-filter="*">All</li>
            <?php foreach ($categories as $cat) : ?>
              <li data-filter=".<?= $cat; ?>"><?= $cat; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="row featured__filter">
      <?php foreach ($products as $item) : ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mix <?= $item['category_name']; ?>">
          <div class="product-item">
            <div class="pi-pic">
              <img src="uploads/itemImages/<?= $item['image']; ?>" alt="" />
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
              <div class="product-price"><?= $item['price']; ?></div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- Featured Section End -->