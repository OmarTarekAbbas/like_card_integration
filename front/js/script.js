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

//loading screen
$(window).on('load', function () {
  'use strict';
  $('.loading-overlay .spinner').fadeOut(1500, function () {
    $('body').css('overflow', 'auto');
    $(this).remove();
  });
});



