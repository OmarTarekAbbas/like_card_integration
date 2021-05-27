/* Start Active Menu Navbar */
$(function () {
  var url = window.location.href;

  $("ul li a").each(function () {});
  $("ul li a").each(function () {
    if (url == (this.href)) {
      $("#indexed").removeClass("active_menu_navbar");
      $(this).closest("li").addClass("active_menu_navbar");
    }
  });
});
/* End Active Menu Navbar */

$(document).ready(function () {
  $(".close_nav").click(function () {
    $('#menu-toggle').prop('checked', false);
  });
});

$(window).scroll(function () {
  if ($(this).scrollTop() > 20) { // If page is scrolled more than 50px
    $('#return-to-top').fadeIn(800); // Fade in the arrow
  } else {
    $('#return-to-top').fadeOut(800); // Else fade out the arrow
  }
});

$('#return-to-top').click(function () { // When arrow is clicked
  $('body,html').animate({
    scrollTop: 0, // Scroll to top of body
  }, 1000);
});

/* Start Upload Img */
var openFile = function (event) {
  var input = event.target;
  console.log('good');
  var reader = new FileReader();
  reader.onload = function () {
    var dataURL = reader.result;
    var output = document.getElementById('output');
    output.src = dataURL;
  };
  reader.readAsDataURL(input.files[0]);
};

function _upload() {
  document.getElementById('file_upload_id').click();
}
/* End Upload Img */


var check = false;

function changeVal(el) {
  var qt = parseFloat(el.parent().children(".qt").html());
  var price = parseFloat(el.parent().children(".price").html());
  var eq = Math.round(price * qt * 100) / 100;

  el.parent().children(".full-price").html(eq + "§");

  changeTotal();
}

function changeTotal() {

  var price = 0;

  $(".full-price").each(function (index) {
    price += parseFloat($(".full-price").eq(index).html());
  });

  price = Math.round(price * 100) / 100;
  var tax = Math.round(price * 0.05 * 100) / 100
  var shipping = parseFloat($(".shipping span").html());
  var fullPrice = Math.round((price + tax + shipping) * 100) / 100;

  if (price == 0) {
    fullPrice = 0;
  }

  $(".subtotal span").html(price);
  $(".tax span").html(tax);
  $(".total span").html(fullPrice);
}

$(document).ready(function () {

  $(".remove").click(function () {
    var el = $(this);
    el.parent().parent().addClass("removed");
    window.setTimeout(
      function () {
        el.parent().parent().slideUp('fast', function () {
          el.parent().parent().remove();
          if ($(".product").length == 0) {
            if (check) {
              $("#cart").html("<h1>The shop does not function, yet!</h1><p>If you liked my shopping cart, please take a second and heart this Pen on <a href='https://codepen.io/ziga-miklic/pen/xhpob'>CodePen</a>. Thank you!</p>");
            } else {
              $("#cart").html("<h1>No products!</h1>");
            }
          }
          changeTotal();
        });
      }, 200);
  });

  $(".qt-plus").click(function () {
    $(this).parent().children(".qt").html(parseInt($(this).parent().children(".qt").html()) + 1);

    $(this).parent().children(".full-price").addClass("added");

    var el = $(this);
    window.setTimeout(function () {
      el.parent().children(".full-price").removeClass("added");
      changeVal(el);
    }, 150);
  });

  $(".qt-minus").click(function () {

    child = $(this).parent().children(".qt");

    if (parseInt(child.html()) > 1) {
      child.html(parseInt(child.html()) - 1);
    }

    $(this).parent().children(".full-price").addClass("minused");

    var el = $(this);
    window.setTimeout(function () {
      el.parent().children(".full-price").removeClass("minused");
      changeVal(el);
    }, 150);
  });

  window.setTimeout(function () {
    $(".is-open").removeClass("is-open")
  }, 1200);

  $(".btn").click(function () {
    check = true;
    $(".remove").click();
  });
});


//loading screen
$(window).on('load', function () {
  'use strict';
  $('.loading-overlay .spinner').fadeOut(1500, function () {
    $('body').css('overflow', 'auto');
    $(this).remove();
  });
});


$(document).ready(function(){
  $('.phone_number .payment_methods .payment').click(function(){
    $('.payment_methods .payment').removeClass("active_methods");
    $(this).addClass("active_methods");
});
});
