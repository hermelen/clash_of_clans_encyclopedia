$("#show-mobile-nav").on("click", function(e){
  e.preventDefault();
  $(this).addClass("hidden");
  $("#hide-mobile-nav").removeClass("hidden");
  $(".nav_center").removeClass("hide-mobile");
});

$("#hide-mobile-nav").on("click", function(e){
  e.preventDefault();
  $(this).addClass("hidden");
  $("#show-mobile-nav").removeClass("hidden");
  $(".nav_center").addClass("hide-mobile");
});

$('.main_li').mouseenter(function(e){
  e.preventDefault();
  main_second_class = $(this).attr('class').split(' ')[1];
  main_ul = $(this).parent();
  main_ul_height = $(main_ul).height()+7;
  $('.primary_ul.'+main_second_class)
  .css('min-height', main_ul_height);
});

$('.primary_li').mouseenter(function(e){
  e.preventDefault();
  primary_second_class = $(this).attr('class').split(' ')[1];
  primary_ul = $(this).parent();
  primary_ul_height = $(primary_ul).height()+7;
  $('.secondary_ul.'+primary_second_class)
  .css('min-height', primary_ul_height);
});

$('.secondary_li').mouseenter(function(e){
  e.preventDefault();
  secondary_second_class = $(this).attr('class').split(' ')[1];
  secondary_ul = $(this).parent();
  secondary_ul_height = $(secondary_ul).height()+7;
  $('.tertiary_ul.'+secondary_second_class)
  .css('min-height', secondary_ul_height);
});
