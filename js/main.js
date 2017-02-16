$(document).ready(function() {
  let timestamp = $('#timestamp').text();
  let relativeTime = moment(timestamp).fromNow();
  $('#timestamp').text(relativeTime);
  window.setInterval(function() {
    let relativeTime = moment(timestamp).fromNow();
    $('#timestamp').text(relativeTime);
  }, 30000);

  var container = $('.cover');
  var scrollTo = $('#tocjump');
  container.scrollTop(
      scrollTo.offset().top - container.offset().top + container.scrollTop() - container.height() / 2
  );
});
