$('.main_li').mouseenter(function(e){
  e.preventDefault();
  main_second_class = $(this).attr('class').split(' ')[1];
  $('.primary_ul.'+main_second_class).addClass('primary_ul_show');
    $('.primary_ul.'+main_second_class).mouseenter(function(e){
      e.preventDefault();
      $(this).addClass('primary_ul_show');
      $('.main_li.'+main_second_class).addClass('hover');

      $('.primary_li').mouseenter(function(e){
        e.preventDefault();
        primary_second_class = $(this).attr('class').split(' ')[1];
        $('.secondary_ul.'+primary_second_class).addClass('secondary_ul_show');

        $('.secondary_ul.'+primary_second_class).mouseenter(function(e){
          e.preventDefault();
          $(this).addClass('secondary_ul_show');
          $('.main_li.'+main_second_class).addClass('hover');
          $('.primary_ul.'+main_second_class).addClass('primary_ul_show');
          $('.primary_li.'+primary_second_class).addClass('hover');

          $('.secondary_li').mouseenter(function(e){
            e.preventDefault();
            secondary_second_class = $(this).attr('class').split(' ')[1];
            $('.tertiary_ul.'+secondary_second_class).addClass('tertiary_ul_show');

            $('.tertiary_ul.'+secondary_second_class).mouseenter(function(e){
              e.preventDefault();
              $(this).addClass('tertiary_ul_show');
              $('.main_li.'+main_second_class).addClass('hover');
              $('.primary_ul.'+main_second_class).addClass('primary_ul_show');
              $('.primary_li.'+primary_second_class).addClass('hover');
              $('.secondary_ul.'+primary_second_class).addClass('secondary_ul_show');
              $('.secondary_li.'+secondary_second_class).addClass('hover');
            });
            $('.tertiary_ul.'+secondary_second_class).mouseleave(function(e){
              e.preventDefault();
              $(this).removeClass('tertiary_ul_show');
              $('.main_li.'+main_second_class).removeClass('hover');
              $('.primary_ul.'+main_second_class).removeClass('primary_ul_show');
              $('.primary_li.'+primary_second_class).removeClass('hover');
              $('.secondary_ul.'+primary_second_class).removeClass('secondary_ul_show');
              $('.secondary_li.'+secondary_second_class).removeClass('hover');
            });
          });
          $('.secondary_li').mouseleave(function(e){
            e.preventDefault();
            secondary_second_class = $(this).attr('class').split(' ')[1];
            $('.tertiary_ul.'+secondary_second_class).removeClass('tertiary_ul_show');
          });
        });
        $('.secondary_ul.'+primary_second_class).mouseleave(function(e){
          e.preventDefault();
          $(this).removeClass('secondary_ul_show');
          $('.main_li.'+main_second_class).removeClass('hover');
          $('.primary_li.'+primary_second_class).removeClass('hover');
          $('.primary_ul.'+main_second_class).removeClass('primary_ul_show');
        });
      });
      $('.primary_li').mouseleave(function(e){
        e.preventDefault();
        primary_second_class = $(this).attr('class').split(' ')[1];
        $('.secondary_ul.'+primary_second_class).removeClass('secondary_ul_show');
      });
    });
    $('.primary_ul.'+main_second_class).mouseleave(function(e){
      e.preventDefault();
      $(this).removeClass('primary_ul_show');
      $('.main_li.'+main_second_class).removeClass('hover');
    });
});
$('.main_li').mouseleave(function(e){
  e.preventDefault();
  main_second_class = $(this).attr('class').split(' ')[1];
  $('.primary_ul.'+main_second_class).removeClass('primary_ul_show');
});

// if ($('.tertiary_ul').height() > 49) {
//   $('.tertiary_ul').addClass('big_ul');
// }
$('.secondary_ul').height(function(){
  if ($(this).height() > 49) {
    $(this).addClass('big_ul');
  }
})

$('.tertiary_ul').height(function(){
  if ($(this).height() > 49) {
    $(this).addClass('big_ul');
  }
})

// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('.nav_all').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();

    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;

    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('.nav_all, .nav_left, .nav_center, .nav_right').removeClass('nav-down').addClass('nav-up');
        $("#show-mobile-nav").removeClass("hidden");
        $(".nav_center").addClass("hide-mobile");
        $("#hide-mobile-nav").addClass("hidden");
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('.nav_all, .nav_left, .nav_center, .nav_right').removeClass('nav-up').addClass('nav-down');
        }
    }

    lastScrollTop = st;
}
