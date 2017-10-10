$('#trainingDurationDetailContainer').click(function(e){
  e.preventDefault();
  $('#trainingDurationDetail').removeClass('hidden');
});

$('#submitTrainingDuration').click(function(e){
  e.preventDefault();
  var durationMinutes = Number(($('#trainingDurationMinutes').val()*60));
  var durationSeconds = Number(($('#trainingDurationSeconds').val()));

  var totalDuration = durationMinutes;
  totalDuration += durationSeconds;
  $('.trainingDuration').val(totalDuration);
  $('#trainingDurationDetail').addClass('hidden');
  $('.trainingDurationDetailContainer').empty();
  $('.trainingDurationDetailContainer').append($('#trainingDurationMinutes').val()+' minute(s) et '+$('#trainingDurationSeconds').val()+' sec');
});

$('#durationDetailContainer').click(function(e){
  e.preventDefault();
  $('#durationDetail').removeClass('hidden');
});

$('#submitDuration').click(function(e){
  e.preventDefault();
  var durationDays = Number(($('#durationDays').val())*86400);
  var durationHours = Number(($('#durationHours').val())*3600);
  var durationMinutes = Number(($('#durationMinutes').val()*60));
  var durationSeconds = Number(($('#durationSeconds').val()));

  var totalDuration = durationDays;
  totalDuration += durationHours;
  totalDuration += durationMinutes;
  totalDuration += durationSeconds;
  $('.improvementDuration').val(totalDuration);
  $('#durationDetail').addClass('hidden');
  $('.durationDetailContainer').empty();
  $('.durationDetailContainer').append($('#durationDays').val()+' jour(s) '+$('#durationHours').val()+' heure(s) '+$('#durationMinutes').val()+' minute(s) et '+$('#durationSeconds').val()+' sec');
});

$('#fullDurationDetailContainer').click(function(e){
  e.preventDefault();
  $('#fullDurationDetail').removeClass('hidden');
});

$('#submitFullDuration').click(function(e){
  e.preventDefault();
  var fullDurationDays = Number(($('#fullDurationDays').val())*86400);
  var fullDurationHours = Number(($('#fullDurationHours').val())*3600);
  var fullDurationMinutes = Number(($('#fullDurationMinutes').val()*60));
  var fullDurationSeconds = Number(($('#fullDurationSeconds').val()));

  var totalFullDuration = fullDurationDays;
  totalFullDuration += fullDurationHours;
  totalFullDuration += fullDurationMinutes;
  totalFullDuration += fullDurationSeconds;
  $('.fullDuration').val(totalFullDuration);
  $('#fullDurationDetail').addClass('hidden');
  $('.fullDurationDetailContainer').empty();
  $('.fullDurationDetailContainer').append($('#fullDurationDays').val()+' jour(s) '+$('#fullDurationHours').val()+' heure(s) '+$('#fullDurationMinutes').val()+' minute(s) et '+$('#fullDurationSeconds').val()+' sec');
});

$('#fullDurationDetailContainer').click(function(e){
  e.preventDefault();
  $('#fullDurationDetail').removeClass('hidden');
});

// $(document).ready(function(){
// $('.fullDurationDetailContainer').append($('#fullDurationDays').val()+' jour(s) '+$('#fullDurationHours').val()+' heure(s) '+$('#fullDurationMinutes').val()+' minute(s) et '+$('#fullDurationSeconds').val()+' sec');
// });
