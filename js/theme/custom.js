jQuery(document).ready(function($) {
  // smooth scroll
  //jQuery.scrollSpeed(100, 800);

  // top menu
  $(".sf-menu").superfish();
  $(".sf-menu").after("<div id='my-menu'>");
  $(".sf-menu").clone().appendTo("#my-menu");
  $("#my-menu").find("*").attr('style', '');
  $("#my-menu").find("ul").removeClass("sf-menu");
  $("#my-menu").mmenu({
    extensions: ["widescreen", "pagedim-black", "effect-menu-slide", "effect-listitems-slide", "fx-menu-zoom", "fx-panels-zoom", "theme-dark"],
    navbar: {
      title: "Western Rehabilitation and Sports Center"
    }
  });
  var api = $("#my-menu").data("mmenu");
  api.bind("closed", function() {
    $(".toggle-mnu").removeClass("on");
  });

  $(".mobile-mnu").click(function() {
    var mmAPI = $("#my-menu").data("mmenu");
    mmAPI.open();
    var thiss = $(this).find(".toggle-mnu");
    mmAPI.bind("open:finish", function() {
      thiss.addClass("on");
    });

    mmAPI.bind("close:finish", function() {
      thiss.removeClass("on");
    });

    $(".main-mnu").slideToggle();
    return false;
  });
  // end top menu

  // newsTabs
  $('.mainBlock .tab').click(function() {
    $('.mainBlock .tab').removeClass('active')
      .eq($(this).index()).addClass('active');
    $('.tab_item').hide().eq($(this).index()).slide();
  }).eq(0).addClass('active');

  //Big Slider
  $(".bigslider-carousel").owlCarousel({
    items: 1,
    slideSpeed: 500,
    animateOut: 'fadeOut',
    autoplay: false,
    autoplayTimeout: 6000,
    loop: false,
    mouseDrag: false,
    singleItem: true,
    dots: false,
    nav: true,
    navText: ''
    // navText: ['<i class="fa fa-angel-double-left"></i>','<i class="fa fa-angel-double-right"></i>']
  });

  //Latest news
  $("#latest-news").owlCarousel({
    nav: true,
    loop: true,
    items: 6,
    margin: 10,
    navText: "",
    autoplay: true,
    pagination: true,
    dots: true,
    responsive: {
      0: {
        items: 1
      },
      480: {
        items: 1
      },
      768: {
        items: 3
      },
      992: {
        items: 4
      }
    }
  });

  //Events
  $("#events").owlCarousel({
    nav: true,
    loop: true,
    items: 6,
    margin: 15,
    navText: "",
    autoplay: true,
    pagination: true,
    responsive: {
      0: {
        items: 1
      },
      480: {
        items: 1
      },
      768: {
        items: 3
      },
      992: {
        items: 4
      }
    }
  });

  //Related posts
  $(".post-list").owlCarousel({
    items: 4,
    nav: true,
    loop: true,
    margin: 5,
    autoplay: true,
    navText: "",
    responsive: {
      0: {
        items: 1
      },
      480: {
        items: 2
      },
      768: {
        items: 2
      },
      992: {
        items: 3
      }
    }
  });

  //Responce
  $("#responce").owlCarousel({
    nav: true,
    pagination: true,
    loop: true,
    margin: 8,
    items: 2,
    navText: ""
  });

  //Partners
  $("#partners").owlCarousel({
    nav: true,
    dots: true,
    loop: true,
    margin: 15,
    navText: "",
    autoplay: false,
    pagination: true,
    responsive: {
      0: {
        items: 1
      },
      480: {
        items: 1
      },
      768: {
        items: 3
      },
      992: {
        items: 6
      }
    }
  });
  // gallery filter activation
  if($('#image-gallery').length){
      $('#image-gallery').mixItUp();
    }
  // card Tabs
  $('#newstab .left-tab').click(function() {
    $('#newstab .left-tab').removeClass('active')
      .eq($(this).index()).addClass('active');
    $('.right-item').hide().eq($(this).index()).fadeIn()
  }).eq(0).addClass('active');

  //Modal in footer
  $("#lowbase").on('click', function(e) {
    $('.ui.modal').modal('show', 'can fit');
  });

  $(".close").on('click', function(e) {
    $('.ui.modal').modal('hide');
  });
// add-even block in project #timeline
$('.inner:even').addClass('left');
$('.inner:odd').addClass('right');
}); //end ready
