
function filterDidChange(filter) {
  $('.filter input').each(function() {
    this.checked = this.value == filter;
  })
  $('div.highlighter-rouge').hide();
  $('.language-'+filter).show();
}

$(document).ready(function() {
  $("div.highlighter-rouge").map(function() {
      if (!$(this).prev().hasClass("highlighter-rouge")) {
          return $(this).nextUntil(":not(.highlighter-rouge)").andSelf();
      }
  }).wrap("<div class='code-container' />");

  var filter = localStorage.getItem('filter');

  var languageLookup = new Set();
  $(".code-container").each(function() {
    $(this).children()
    .filter(function() {
      return $(this).attr('class').indexOf('language-') >= 0;
    }).map(function() {
      return /language-([a-z0-9]+)/.exec($(this).attr('class'))[1];
    }).each(function(index, language) {
      languageLookup.add(language);
    });
  });
  allLanguages = Array.from(languageLookup);
  allLanguages.sort();

  if (filter === null || !languageLookup.has(filter)) {
    if (languageLookup.has('javascript')) {
      filter = 'javascript';
    } else {
      filter = allLanguages[0];
    }
  }

  var editThisPageUrl = $('#edit-this-page').attr('href');

  $(".code-container").each(function() {
    var panel = $("<div class='filter' />");
    var form = $("<form />");
    var radios = $(allLanguages).map(function(index, language) {
      var radio = $('<input class="filter-' + language + '" type="radio" name="filterby" value="' + language + '">');

      if (filter == language) {
        radio.click();
      }

      radio.on('click', function() {
        filterDidChange(this.value);
        localStorage.setItem('filter', this.value);
      });
      
      var label = $('<label>');
      label.html(language);
      label.append(radio);

      return label;

    }).each(function() { form.append(this); })

    var languages = $(this)
    .children()
    .filter(function() {
      return $(this).attr('class').indexOf('language-') >= 0;
    }).map(function() {
      return /language-([a-z0-9]+)/.exec($(this).attr('class'))[1];
    });
    var writtenLanguages = new Set();
    languages.each(function(index, language) {
      writtenLanguages.add(language);
    });

    var container = $(this);
    $(allLanguages).each(function(index, language) {
      if (!writtenLanguages.has(language)) {
        var missingCode = $('<div class="missing-code language-' + language + ' highlighter-rouge">');
        var pre = $('<pre class="highlight">');
        pre.append("No code in this language yet, but <a href=" + editThisPageUrl + ">we welcome contributions</a>.");
        missingCode.append(pre);
        container.append(missingCode);
      }
    });

    panel.append(form);
    $(this).append(panel);
  });

  filterDidChange(filter);
  
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

  svgPanZoom('#tech-tree');
});
