(function () {
    "use strict";
    document
    .querySelector('[data-toggle="offcanvas"]')
    .addEventListener("click", function () {
    document.querySelector(".offcanvas-collapse").classList.toggle("open");
    });
})();


$(function(){
    var nav = $('.navbar-collapse'),
        animateTime = 500,
        navLink = $('.navbar-toggler ');
    navLink.click(function(){
      if(nav.height() === 0){
        autoHeightAnimate(nav, animateTime);
      
      } else {
        nav.stop().animate({ height: '0' }, animateTime);
       
      }
    });
  })
  
  /* Function to animate height: auto */
  function autoHeightAnimate(element, time){
        var curHeight = element.height(), // Get Default Height
          autoHeight = element.css('height', 'auto').height(); // Get Auto Height
            element.height(curHeight); // Reset to Default Height
            element.stop().animate({ height: autoHeight }, time); // Animate to Auto Height
  }
//  menu navbar toggle
jQuery('.navbar-toggler').on('click', function () {
    jQuery(this).toggleClass('change')
});
jQuery(document).ready(function() {
    jQuery(window).scroll(function(){
        if (jQuery(window).scrollTop() >= 1) {
            jQuery('.top-header').addClass('fixed');
        }
        else {
            jQuery('.top-header').removeClass('fixed');
        }
    });
});


$(document).ready(function() {
    // Function to close the dropdown when scrolling
    function closeDropdownOnScroll() {
      $('.dropdown-menu').collapse('hide'); // Close the dropdown
    }

    // Attach the scroll event listener to the document
    $(document).on('scroll', function() {
      closeDropdownOnScroll();
    });
});


