if (typeof $ == "undefined") {
  var $ = jQuery;
}

var getUrlParameter = function getUrlParameter(sParam) {
  var sPageURL = window.location.search.substring(1),
    sURLVariables = sPageURL.split("&"),
    sParameterName,
    i;

  for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split("=");

    if (sParameterName[0] === sParam) {
      return sParameterName[1] === undefined
        ? true
        : decodeURIComponent(sParameterName[1]);
    }
  }
  return false;
};

function copyToClipboard(text) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val(text).select();
  document.execCommand("copy");
  $temp.remove();
}

$(function () {
  var url = window.location.pathname,
    urlRegExp = new RegExp(url.replace(/\/$/, "") + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
  //avoid homepage
  if (url != "/") {
    // now grab every link from the navigation
    $(".navbar-nav .nav-item a").each(function () {
      // and test its normalized href against the url pathname regexp
      if (urlRegExp.test(this.href.replace(/\/$/, ""))) {
        $(this).parent("li").addClass("current-menu-item");
        $(this).parents("li.has-children").addClass("current-menu-ancestor");
      }
    });
  }

  // opens external links in new tab
  $("a[href^=http]").each(function () {
    if (
      this.href.indexOf(location.hostname) == -1 &&
      (this.href.indexOf("sahaj.verifinow.in") == -1 ||
        this.href.indexOf("sahaj.ai") == -1)
    ) {
      $(this).attr({
        target: "_blank",
        "aria-label": "(opens in a new tab)",
        rel: "noopener noreferrer",
      });
    }
  });

  $(".subpage-tabs .nav-item button").on("shown.bs.tab", function (e) {
    var href = $(this).attr("data-href");
    $("html, body").animate(
      {
        scrollTop: $(".tab-content").offset().top - 150,
      },
      "slow"
    );
    if (href != "") {
      window.history.pushState("", "", href);
    }
    e.preventDefault();
  });

  $(document).on("click", ".ie-ribbon-banner-close-btn", function () {
    $(".ie-ribbon-banner").remove();
    $("body").removeClass("ie-layout-has-ribbon");
  });

  if ($(".c-widget .c-subscribe input.tnp-email").length > 0) {
    var plh = $('.c-widget .c-subscribe label[for="tnp-1"]').text();
    $(".c-widget .c-subscribe input.tnp-email").attr("placeholder", plh);
  }
});

// Tooltip
// $(".js-share__link--clipboard").tooltip({
//   trigger: "click",
//   placement: "bottom",
// });

// function setTooltip(btn, message) {
//   $(btn).tooltip("hide").attr("data-original-title", message).tooltip("show");
// }

// function hideTooltip(btn) {
//   setTimeout(function () {
//     $(btn).tooltip("hide");
//   }, 1000);
// }

// Clipboard
