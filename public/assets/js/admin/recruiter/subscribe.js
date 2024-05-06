$(document).ready(function () {
    var subscriptionCards = $(".subscription-card");
    if (subscriptionCards.length > 3) {
      $(".subscriptions").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        // autoplay: true,
        // autoplaySpeed: 2000,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
      });
    }
  });
  
  $(document).ready(function () {
    $(".monthly").click(function () {
      $(this).addClass('active');
      $(".yearly").removeClass("active");
      $(".switch").animate({ left: "0" }, 300);
    });
  
    $(".yearly").click(function () {
      $(this).addClass('active');
      $(".monthly").removeClass("active");
      var switchWidth = $(".switch").width();
      $(".switch").animate({ left: "calc(100% - " + switchWidth + "px)" }, 300);
    });
  });