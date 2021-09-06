<?php
if (!isset($cartIds)) {
  if (isset($_SESSION['userId'])) {
    $cartIds = $cart->getCartIds($product->getData("SELECT * FROM cart WHERE user_id=$_SESSION[userId]"));
  } else {
    $cartIds = array_keys($_SESSION['cart']);
  }
}
?>

<div class="row">
  <?php foreach ($result as $item) : ?>
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

<script>
  (function($) {
    var bagBtn = $('.bag-icon');
    bagBtn.on('click', function() {
      var $button = $(this);
      var itemId = $button.data('itemid');
      var userId = $button.data('userid');
      var bagIcons = $(`.bag-icon[data-itemid='${itemId}']`);
      var cartIcon = $('.cart-icon a span');
      var NewCartCount = parseInt(cartIcon.text()) + 1;

      $.ajax({
        type: 'post',
        url: 'process-data.php',
        data: {
          itemId: itemId,
          userId: userId,
          bag: 'insert'
        },
        success: function(response) {
          bagIcons.addClass('icon_bag_green');
          bagIcons.attr('disabled', true);
          cartIcon.text(NewCartCount);
        },
      });
    });
  })(jQuery);
</script>