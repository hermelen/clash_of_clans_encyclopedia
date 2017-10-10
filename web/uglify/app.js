$('.nb').mouseenter(function(e){
  e.preventDefault();
  $('.info_duration_detail').removeClass('hidden');
});
$('.nb').mouseleave(function(e){
  e.preventDefault();
  $('.info_duration_detail').addClass('hidden');
});
