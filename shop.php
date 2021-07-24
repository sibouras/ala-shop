<?php
$pageTitle = 'Shop';
include('includes/templates/header.php');

$products = $product->getData(
  "SELECT items.*,
    categories.name AS category_name
  FROM items
    INNER JOIN categories ON categories.id = items.category_id LIMIT 9;
  "
);
// shuffle($products);

if (!isset($cartIds)) {
  if (isset($_SESSION['userId'])) {
    $cartIds = $cart->getCartIds($product->getData("SELECT * FROM cart WHERE user_id=$_SESSION[userId]"));
  } else {
    $cartIds = array_keys($_SESSION['cart']);
  }
}
?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-text">
          <a href="index.php"><i class="fa fa-home"></i> Home</a>
          <span>Shop</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Product Shop Section Begin -->
<section class="product-shop spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
        <div class="filter-widget">
          <h4 class="fw-title">Categories</h4>
          <ul class="filter-catagories">
            <?php foreach ($categories as $cat) : ?>
              <li><a href="#"><?= $cat['name']; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="filter-widget">
          <h4 class="fw-title">Brand</h4>
          <div class="fw-brand-check">
            <div class="bc-item">
              <label for="bc-calvin">
                Asus
                <input type="checkbox" id="bc-calvin">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="bc-item">
              <label for="bc-diesel">
                Lenovo
                <input type="checkbox" id="bc-diesel">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="bc-item">
              <label for="bc-polo">
                Logitech
                <input type="checkbox" id="bc-polo">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="bc-item">
              <label for="bc-tommy">
                Dell
                <input type="checkbox" id="bc-tommy">
                <span class="checkmark"></span>
              </label>
            </div>
          </div>
        </div>
        <div class="filter-widget">
          <h4 class="fw-title">Price</h4>
          <div class="filter-range-wrap">
            <div class="range-slider">
              <div class="price-input">
                <input type="text" id="minamount">
                <input type="text" id="maxamount">
              </div>
            </div>
            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="33" data-max="199">
              <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
              <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
              <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
            </div>
          </div>
          <a href="#" class="filter-btn">Filter</a>
        </div>
        <div class="filter-widget">
          <h4 class="fw-title">Tags</h4>
          <div class="fw-tags">
            <a href="#">Laptops</a>
            <a href="#">Desktops</a>
            <a href="#">Mice</a>
            <a href="#">Keyboards</a>
            <a href="#">Chairs</a>
            <a href="#">Smartphones</a>
            <a href="#">Consoles</a>
          </div>
        </div>
      </div>
      <div class="col-lg-9 order-1 order-lg-2">
        <div class="product-show-option">
          <div class="row">
            <div class="col-lg-7 col-md-7">
              <div class="select-option">
                <select class="sorting">
                  <option value="">Default Sorting</option>
                </select>
                <select class="p-show">
                  <option value="">Show:</option>
                </select>
              </div>
            </div>
            <div class="col-lg-5 col-md-5 text-right">
              <p>Show 01- 09 Of 36 Product</p>
            </div>
          </div>
        </div>
        <div class="product-list">
          <div class="row">
            <?php foreach ($products as $item) : ?>
              <div class="col-lg-4 col-sm-6">
                <div class="product-item">
                  <div class="pi-pic">
                    <a href="product.php?item_id=<?= $item['id']; ?>">
                      <img src="uploads/itemImages/<?= $item['image']; ?>" alt="" />
                    </a>
                    <div class="sale pp-sale">Sale</div>
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
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="loading-more">
          <i class="icon_loading"></i>
          <a href="#">
            Loading More
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Product Shop Section End -->

<?php include('includes/templates/footer.php'); ?>