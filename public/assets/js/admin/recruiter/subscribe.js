$(document).ready(function () {
    var subscriptionCards = $(".subscription-card");
    if (subscriptionCards.length > 3) {
      $(".subscriptions").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
        prevArrow: '<button type="button" class="slick-prev">Previous</button>',
        nextArrow: '<button type="button" class="slick-next">Next</button>',
      });
  
      // Enable mouse wheel scrolling
      $('.slick-slider').on('wheel', (function(e) {
        e.preventDefault();
        if (e.originalEvent.deltaY > 0) {
          $(this).slick('slickNext');
        } else {
          $(this).slick('slickPrev');
        }
      }));
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