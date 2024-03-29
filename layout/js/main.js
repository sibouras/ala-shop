/*  ---------------------------------------------------
    Template Name: Fashi
    Description: Fashi eCommerce HTML Template
    Author: Colorlib
    Author URI: https://colorlib.com/
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

'use strict';

(function ($) {
  /*------------------
        Preloader
    --------------------*/
  $(window).on('load', function () {
    $('.loader').fadeOut();
    $('#preloder').delay(200).fadeOut('slow');

    /*------------------
          Gallery filter
      --------------------*/
    $('.featured__controls li').on('click', function () {
      $('.featured__controls li').removeClass('active');
      $(this).addClass('active');
    });
    if ($('.featured__filter').length > 0) {
      var containerEl = document.querySelector('.featured__filter');
      var mixer = mixitup(containerEl);
    }
  });

  /*------------------
        Background Set
    --------------------*/
  $('.set-bg').each(function () {
    var bg = $(this).data('setbg');
    $(this).css('background-image', 'url(' + bg + ')');
  });

  /*------------------
		Navigation
	--------------------*/
  $('.mobile-menu').slicknav({
    prependTo: '#mobile-menu-wrap',
    allowParentLinks: true,
  });

  /*------------------
        Hero Slider
    --------------------*/
  $('.hero-items').owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    items: 1,
    dots: false,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    navText: [
      '<i class="ti-angle-left"></i>',
      '<i class="ti-angle-right"></i>',
    ],
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
  });

  /*------------------
        Product Slider
    --------------------*/
  $('.product-slider').owlCarousel({
    loop: true,
    margin: 25,
    nav: true,
    items: 4,
    dots: true,
    navText: [
      '<i class="ti-angle-left"></i>',
      '<i class="ti-angle-right"></i>',
    ],
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 2,
      },
      992: {
        items: 2,
      },
      1200: {
        items: 3,
      },
    },
  });
  /*------------------
        New Products Slider
    --------------------*/
  $('.new-products-slider').owlCarousel({
    loop: true,
    margin: 25,
    nav: true,
    items: 4,
    dots: true,
    navText: [
      '<i class="ti-angle-left"></i>',
      '<i class="ti-angle-right"></i>',
    ],
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 2,
      },
      992: {
        items: 3,
      },
      1200: {
        items: 4,
      },
    },
  });

  /*------------------
       New products Carousel
    --------------------*/
  // $('.new-products-carousel').owlCarousel({
  // dots: true,
  // items: 2,
  // });

  /*------------------
       logo Carousel
    --------------------*/
  $('.logo-carousel').owlCarousel({
    loop: false,
    margin: 30,
    nav: false,
    items: 5,
    dots: false,
    navText: [
      '<i class="ti-angle-left"></i>',
      '<i class="ti-angle-right"></i>',
    ],
    smartSpeed: 1200,
    autoHeight: false,
    mouseDrag: false,
    autoplay: true,
    responsive: {
      0: {
        items: 3,
      },
      768: {
        items: 5,
      },
    },
  });

  /*-----------------------
       Product Single Slider
    -------------------------*/
  $('.ps-slider').owlCarousel({
    loop: false,
    margin: 10,
    nav: true,
    items: 3,
    dots: false,
    navText: [
      '<i class="fa fa-angle-left"></i>',
      '<i class="fa fa-angle-right"></i>',
    ],
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
  });

  /*------------------
        CountDown
    --------------------*/
  // For demo preview
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();

  if (mm == 12) {
    mm = '01';
    yyyy = yyyy + 1;
  } else {
    mm = parseInt(mm) + 1;
    mm = String(mm).padStart(2, '0');
  }
  var timerdate = mm + '/' + dd + '/' + yyyy;
  // For demo preview end

  console.log(timerdate);

  // Use this for real timer date
  /* var timerdate = "2020/01/01"; */

  $('#countdown').countdown(timerdate, function (event) {
    $(this).html(
      event.strftime(
        "<div class='cd-item'><span>%D</span> <p>Days</p> </div>" +
          "<div class='cd-item'><span>%H</span> <p>Hrs</p> </div>" +
          "<div class='cd-item'><span>%M</span> <p>Mins</p> </div>" +
          "<div class='cd-item'><span>%S</span> <p>Secs</p> </div>"
      )
    );
  });

  /*----------------------------------------------------
     Language Flag js
    ----------------------------------------------------*/
  $(document).ready(function (e) {
    //no use
    try {
      var pages = $('#pages')
        .msDropdown({
          on: {
            change: function (data, ui) {
              var val = data.value;
              if (val != '') window.location = val;
            },
          },
        })
        .data('dd');

      var pagename = document.location.pathname.toString();
      pagename = pagename.split('/');
      pages.setIndexByValue(pagename[pagename.length - 1]);
      $('#ver').html(msBeautify.version.msDropdown);
    } catch (e) {
      // console.log(e);
    }
    $('#ver').html(msBeautify.version.msDropdown);

    //convert
    $('.language_drop').msDropdown({ roundedBorder: false });
    $('#tech').data('dd');
  });
  /*-------------------
		Range Slider
	--------------------- */
  var rangeSlider = $('.price-range'),
    minamount = $('#minamount'),
    maxamount = $('#maxamount'),
    minPrice = rangeSlider.data('min'),
    maxPrice = rangeSlider.data('max'),
    timeoutSliderId;
  rangeSlider.slider({
    range: true,
    min: minPrice,
    max: maxPrice,
    values: [minPrice, maxPrice],
    slide: function (event, ui) {
      minamount.val('$' + ui.values[0]);
      maxamount.val('$' + ui.values[1]);
      $('#hidden-min-price').val(ui.values[0]);
      $('#hidden-max-price').val(ui.values[1]);
      clearTimeout(timeoutSliderId);
      $('.product-list').html('<div id="loading"></div>');
      timeoutSliderId = setTimeout(() => {
        filterPrice();
      }, 80);
    },
  });
  minamount.val('$' + rangeSlider.slider('values', 0));
  maxamount.val('$' + rangeSlider.slider('values', 1));

  function filterPrice() {
    const minPrice = $('#hidden-min-price').val();
    const maxPrice = $('#hidden-max-price').val();
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const category = urlParams.get('category');
    $.ajax({
      url: 'process-data.php',
      method: 'POST',
      data: {
        minPrice: minPrice,
        maxPrice: maxPrice,
        category: category,
      },
      success: function (data) {
        $('.product-list').html(data);
      },
    });
  }

  3; /*-------------------
		Radio Btn
	--------------------- */
  $('.fw-size-choose .sc-item label, .pd-size-choose .sc-item label').on(
    'click',
    function () {
      $(
        '.fw-size-choose .sc-item label, .pd-size-choose .sc-item label'
      ).removeClass('active');
      $(this).addClass('active');
    }
  );

  /*-------------------
		Nice Select
    --------------------- */
  $('.sorting, .p-show').niceSelect();

  /*------------------
		Single Product
	--------------------*/
  $('.product-thumbs-track .pt').on('click', function () {
    $('.product-thumbs-track .pt').removeClass('active');
    $(this).addClass('active');
    var imgurl = $(this).data('imgbigurl');
    var bigImg = $('.product-big-img').attr('src');
    if (imgurl != bigImg) {
      $('.product-big-img').attr({ src: imgurl });
      $('.zoomImg').attr({ src: imgurl });
    }
  });

  $('.product-pic-zoom').zoom();

  /*-------------------
		Quantity change
	--------------------- */
  var proQty = $('.pro-qty');
  proQty.prepend('<span class="dec qtybtn">-</span>');
  proQty.append('<span class="inc qtybtn">+</span>');
  proQty.on('click', '.qtybtn', function () {
    var $button = $(this);
    var oldValue = $button.parent().find('input').val();
    if ($button.hasClass('inc')) {
      var newVal = parseFloat(oldValue) + 1;
    } else {
      // Don't allow decrementing below zero
      if (oldValue > 1) {
        var newVal = parseFloat(oldValue) - 1;
      } else {
        newVal = 1;
      }
    }
    $button.parent().find('input').val(newVal);

    var itemId = $button.parent().find('input').data('id');
    var price = $(`.p-price[data-id=${itemId}]`).data('price');
    var $total = $(`.total-price[data-id=${itemId}]`);
    var $subTotal = $('.subtotal span');
    var $cartTotal = $('.cart-total span');

    $.ajax({
      type: 'post',
      url: 'process-data.php',
      data: { itemId: itemId, qty: newVal },
      success: function (response) {
        if (!response.error) {
          $total.text('$' + formatPrice(price * newVal));
          $total.attr('data-total', (price * newVal).toFixed(2));
          var totalArr = [];
          getTotals(totalArr);
          $subTotal.text('$' + formatPrice(getSubtotal(totalArr)));
          $subTotal.attr('data-subtotal', getSubtotal(totalArr));
          $cartTotal.text('$' + formatPrice(getSubtotal(totalArr)));
        }
      },
    });
  });

  function getTotals(totalArr) {
    $('#table-body tr').each(function () {
      var row = $(this);
      var price = row.find('.total-price').attr('data-total');
      console.log('🚀 ~ price', price);
      if (price) {
        totalArr.push(parseFloat(price));
      }
    });
  }

  function getSubtotal(totalArr) {
    var sum = 0;
    totalArr.forEach((price) => {
      return (sum += price);
    });
    return sum;
  }

  function formatPrice(num, digits = 2) {
    return num.toLocaleString('en-US', { minimumFractionDigits: digits });
  }

  function unformatPrice(formated) {
    return parseFloat(formated.replaceAll(',', ''));
  }

  function calcNewSubTotal(oldSubTotal, rowTotal) {
    const result = parseFloat(oldSubTotal) - parseFloat(rowTotal);
    return result.toFixed(2);
  }

  /*-------------------
		Delete cart item
	--------------------- */
  var closeBtn = $('.delete-cart-item');
  closeBtn.on('click', function () {
    var $button = $(this);
    var itemId = $button.data('id');
    var rowTotal = $(`.total-price[data-id=${itemId}]`).data('total');
    var $subTotal = $('.subtotal span');
    var $cartTotal = $('.cart-total span');
    // used javascript because jquery stores the first clicked value
    var subTotalSpan = document.querySelector('.subtotal span');
    var oldSubTotal = subTotalSpan.dataset.subtotal;
    var newSubTotal = calcNewSubTotal(oldSubTotal, rowTotal);
    var cartIcon = $('.cart-icon a span');
    var NewCartCount = parseInt(cartIcon.text()) - 1;

    $.ajax({
      type: 'post',
      url: 'process-data.php',
      data: { itemId: itemId, deleteCartItem: 'set' },
      success: function (response) {
        var row = $button.parent().parent();
        // removed class because getTotals function searches for it
        row.find('.total-price').removeClass('total-price');
        row.hide();
        $subTotal.text('$' + newSubTotal);
        $subTotal.attr('data-subtotal', newSubTotal);
        $cartTotal.text('$' + newSubTotal);
        cartIcon.text(NewCartCount);
      },
    });
  });

  /*-------------------
		Empty cart
	--------------------- */
  var emptyBtn = $('.empty-cart');
  emptyBtn.on('click', function () {
    var tableBody = $('#table-body');
    var $subTotal = $('.subtotal span');
    var $cartTotal = $('.cart-total span');
    var cartIcon = $('.cart-icon a span');

    $.ajax({
      type: 'post',
      url: 'process-data.php',
      data: { emptyCart: 'set' },
      success: function (response) {
        tableBody.html('');
        $subTotal.text('$0');
        $cartTotal.text('$0');
        cartIcon.text(0);
      },
    });
  });

  /*-------------------
		Add item to cart
	--------------------- */
  var bagBtn = $('.bag-icon');
  bagBtn.on('click', function () {
    var $button = $(this);
    var itemId = $button.data('itemid');
    var userId = $button.data('userid');
    var bagIcons = $(`.bag-icon[data-itemid='${itemId}']`);
    var cartIcon = $('.cart-icon a span');
    var NewCartCount = parseInt(cartIcon.text()) + 1;

    $.ajax({
      type: 'post',
      url: 'process-data.php',
      data: { itemId: itemId, userId: userId, bag: 'insert' },
      success: function (response) {
        bagIcons.addClass('icon_bag_green');
        bagIcons.attr('disabled', true);
        cartIcon.text(NewCartCount);
      },
    });
  });
})(jQuery);
