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

//loading screen
$(window).on('load', function () {
  'use strict';
  $('.loading-overlay .spinner').fadeOut(1500, function () {
    $('body').css('overflow', 'auto');
    $(this).remove();
  });
});

jQuery(document).ready(($) => {
  $('.quantity').on('click', '.plus', function(e) {
      let $input = $(this).prev('input.qty');
      let val = parseInt($input.val());
      $input.val( val+1 ).change();
  });

  $('.quantity').on('click', '.minus', 
      function(e) {
      let $input = $(this).next('input.qty');
      var val = parseInt($input.val());
      if (val > 0) {
          $input.val( val-1 ).change();
      } 
  });
});