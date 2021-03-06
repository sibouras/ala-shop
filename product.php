<?php
$pageTitle = 'Details';
include('includes/templates/header.php');

$item_id = $_GET['item_id'] ?? 1;
$item = $product->getData(
  "SELECT items.*,
    categories.name AS category_name
  FROM items
    INNER JOIN categories ON categories.id = items.category_id
  WHERE items.id = $item_id;
  "
);
$item = $item[0];

if (isset($_SESSION['userId'])) {
  $cartIds = $cart->getCartIds($product->getData("SELECT * FROM cart WHERE user_id=$_SESSION[userId]"));
} else {
  $cartIds = array_keys($_SESSION['cart']);
}
?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-text product-more">
          <a href="./index.php"><i class="fa fa-home"></i> Home</a>
          <a href="./shop.php">Shop</a>
          <span><?= $item['name']; ?></span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Product Shop Section Begin -->
<section class="product-shop spad page-details">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-6">
            <div class="product-pic-zoom">
              <img class="product-big-img" src="uploads/itemImages/<?= $item['image']; ?>" alt="" />
              <div class="zoom-icon">
                <i class="fa fa-search-plus"></i>
              </div>
            </div>
            <div class="product-thumbs">
              <div class="product-thumbs-track ps-slider owl-carousel">
                <div class="pt active" data-imgbigurl="uploads/itemImages/<?= $item['image']; ?>">
                  <img src="uploads/itemImages/<?= $item['image']; ?>" alt="" />
                </div>
                <div class="pt" data-imgbigurl="layout/img/product-single/image-not-available.png">
                  <img src="layout/img/product-single/image-not-available.png" alt="" />
                </div>
                <div class="pt" data-imgbigurl="layout/img/product-single/image-not-available.png">
                  <img src="layout/img/product-single/image-not-available.png" alt="" />
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="product-details">
              <div class="pd-title">
                <span><?= $item['category_name']; ?></span>
                <h3><?= $item['name']; ?></h3>
                <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
              </div>
              <div class="pd-rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
                <span>(4)</span>
              </div>
              <div class="pd-desc">
                <p><?= $item['description']; ?></p>
                <h4 class="product-price">
                  $<?= number_format($item['price'], 2); ?>
                  <span>
                    <?php
                    $price = (float) $item['price'];
                    $result = $price + ($price * 30 / 100);
                    echo '&' . number_format($result, 2);
                    ?>
                  </span>
                </h4>
              </div>
              <div class="pd-color">
                <h6>Color</h6>
                <div class="pd-color-choose">
                  <div class="cc-item">
                    <input type="radio" id="cc-black" />
                    <label for="cc-black"></label>
                  </div>
                  <div class="cc-item">
                    <input type="radio" id="cc-yellow" />
                    <label for="cc-yellow" class="cc-yellow"></label>
                  </div>
                  <div class="cc-item">
                    <input type="radio" id="cc-violet" />
                    <label for="cc-violet" class="cc-violet"></label>
                  </div>
                </div>
              </div>
              <div class="quantity">
                <div class="pro-qty">
                  <input type="text" value="1" />
                </div>
                <?php if (in_array($item['id'], $cartIds)) : ?>
                  <a href="#" class="primary-btn pd-cart disable-cart">Add To Cart</a>
                <?php else : ?>
                  <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                <?php endif; ?>
              </div>
              <ul class="pd-tags">
                <li>
                  <span>CATEGORIES</span>: More Accessories, Wallets & Cases
                </li>
                <li><span>TAGS</span>: Gaming, Powerful, Ergonomic</li>
              </ul>
              <div class="pd-share">
                <div class="p-code">Sku : 00012</div>
                <div class="pd-social">
                  <a href="#"><i class="ti-facebook"></i></a>
                  <a href="#"><i class="ti-twitter-alt"></i></a>
                  <a href="#"><i class="ti-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="product-tab">
          <div class="tab-item">
            <ul class="nav" role="tablist">
              <li>
                <a class="active" data-toggle="tab" href="#tab-1" role="tab">DESCRIPTION</a>
              </li>
              <li>
                <a data-toggle="tab" href="#tab-2" role="tab">SPECIFICATIONS</a>
              </li>
              <li>
                <a data-toggle="tab" href="#tab-3" role="tab">Customer Reviews (02)</a>
              </li>
            </ul>
          </div>
          <div class="tab-item-content">
            <div class="tab-content">
              <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                <div class="product-content">
                  <div class="row">
                    <div class="col-lg-7">
                      <h5>Introduction</h5>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in
                      </p>
                      <h5>Features</h5>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis
                        nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in
                      </p>
                    </div>
                    <div class="col-lg-5">
                      <img src="layout/img/product-single/tab-desc-1.jpg" alt="" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="tab-2" role="tabpanel">
                <div class="specification-table">
                  <table>
                    <tr>
                      <td class="p-catagory">Customer Rating</td>
                      <td>
                        <div class="pd-rating">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-o"></i>
                          <span>(5)</span>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="p-catagory">Price</td>
                      <td>
                        <div class="p-price">$495.00</div>
                      </td>
                    </tr>
                    <tr>
                      <td class="p-catagory">Add To Cart</td>
                      <td>
                        <div class="cart-add">+ add to cart</div>
                      </td>
                    </tr>
                    <tr>
                      <td class="p-catagory">Availability</td>
                      <td>
                        <div class="p-stock">22 in stock</div>
                      </td>
                    </tr>
                    <tr>
                      <td class="p-catagory">Weight</td>
                      <td>
                        <div class="p-weight">1,3kg</div>
                      </td>
                    </tr>
                    <tr>
                      <td class="p-catagory">Size</td>
                      <td>
                        <div class="p-size">Xxl</div>
                      </td>
                    </tr>
                    <tr>
                      <td class="p-catagory">Color</td>
                      <td><span class="cs-color"></span></td>
                    </tr>
                    <tr>
                      <td class="p-catagory">Sku</td>
                      <td>
                        <div class="p-code">00012</div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="tab-3" role="tabpanel">
                <div class="customer-review-option">
                  <h4>2 Comments</h4>
                  <div class="comment-option">
                    <div class="co-item">
                      <div class="avatar-pic">
                        <img src="layout/img/product-single/avatar-1.png" alt="" />
                      </div>
                      <div class="avatar-text">
                        <div class="at-rating">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-o"></i>
                        </div>
                        <h5>Brandon Kelley <span>27 Aug 2019</span></h5>
                        <div class="at-reply">Nice !</div>
                      </div>
                    </div>
                    <div class="co-item">
                      <div class="avatar-pic">
                        <img src="layout/img/product-single/avatar-2.png" alt="" />
                      </div>
                      <div class="avatar-text">
                        <div class="at-rating">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-o"></i>
                        </div>
                        <h5>Roy Banks <span>27 Aug 2019</span></h5>
                        <div class="at-reply">Nice !</div>
                      </div>
                    </div>
                  </div>
                  <div class="personal-rating">
                    <h6>Your Ratind</h6>
                    <div class="rating">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star-o"></i>
                    </div>
                  </div>
                  <div class="leave-comment">
                    <h4>Leave A Comment</h4>
                    <form action="#" class="comment-form">
                      <div class="row">
                        <div class="col-lg-6">
                          <input type="text" placeholder="Name" />
                        </div>
                        <div class="col-lg-6">
                          <input type="text" placeholder="Email" />
                        </div>
                        <div class="col-lg-12">
                          <textarea placeholder="Messages"></textarea>
                          <button type="submit" class="site-btn">
                            Send message
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Product Shop Section End -->

<!-- Related Products Section End -->
<?php // include('includes/templates/_related-products.php'); 
?>
<!-- Related Products Section End -->

<!-- New Products Section Begin -->
<?php include('includes/templates/_new-products.php'); ?>
<!-- New Products Section End -->

<?php
include('includes/templates/footer.php');
?>