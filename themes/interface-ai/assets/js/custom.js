jQuery(document).ready(function () {
  // jQuery('.test').owlCarousel({
  //     loop: true,
  //     nav: false,
  //     dots: false,
  //     autoplay: true,
  //     autoplayTimeout: 3000,
  //     animateOut: 'fadeOut',
  //     autoplayHoverPause: true,
  //     items: 4,
  //     margin: 24,
  //     responsive: {
  //         0: {
  //             loop: true,
  //             items: 1,
  //             margin:10,
  //             stagePadding: 100,
  //         },
  //         768: {
  //             items: 4
  //         },

  //     }
  // });
  jQuery(".home-slider").slick({
    dots: false,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    arrows: true,
    cssEase: "ease",
    fade: true,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 400,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  jQuery(".client-logo-slider").slick({
    draggable: false,
    slidesToShow: 6,
    infinite: true,
    slidesToScroll: 6,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 0,
    speed: 5000,
    cssEase: "linear",
    pauseOnHover: true,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
        },
      },
    ],
  });

  jQuery(".case-study-slider").slick({
    dots: false,
    infinite: true,
    speed: 500,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    arrows: true,
    cssEase: "ease",
    fade: true,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  if (jQuery(window).width() < 992) {
    jQuery(".sol-card-wrap").slick({
      dots: true,
      infinite: true,
      speed: 500,
      slidesToShow: 2,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 5000,
      arrows: false,
      responsive: [
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: true,
            infinite: false,
          },
        },
      ],
    });
  }
});

jQuery(window).on("load", function () {
  if (jQuery(window).width() > 767) {
    // equalheight('.single-advantage p');
  }
  if (jQuery(window).width() < 768) {
    // equalheight('.plateform-slide-main h3');
  }
});
jQuery(window).resize(function () {
  if (jQuery(window).width() > 767) {
    // equalheight('.single-advantage p');
  }
  if (jQuery(window).width() < 768) {
    // equalheight('.plateform-slide-main h3');
  }
});

var myOffcanvas = document.getElementById("offcanvasRight");
myOffcanvas.addEventListener("show.bs.offcanvas", function () {
  if (jQuery("#offcanvasRight .offcanvas-body").html() == "") {
    jQuery("#offcanvasRight .offcanvas-body").load(
      "/wp-content/themes/interface-ai/assets/js/calendly.html"
    );
  }
});
