
function filterDidChange(filter) {
  localStorage.setItem('filter', filter);
  $('.filter input').each(function() {
    this.checked = this.value == filter;
  })
  $('.highlighter-rouge').hide();
  $('.language-'+filter).show();
}


$(document).ready(function() {
  $("div.highlighter-rouge").map(function() {
      if (!$(this).prev().hasClass("highlighter-rouge")) {
          return $(this).nextUntil(":not(.highlighter-rouge)").andSelf();
      }
  }).wrap("<div class='code-container' />");

  var filter = localStorage.getItem('filter');

  var allLanguages = new Set();
  $(".code-container").each(function() {
    $(this).children().map(function() {
      return /language-([a-z0-9]+)/.exec($(this).attr('class'))[1];
    }).each(function(index, language) {
      allLanguages.add(language);
    });
  });
  allLanguages = Array.from(allLanguages);
  allLanguages.sort();
  
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
      });
      
      var label = $('<label>');
      label.html(language);
      label.append(radio);

      return label;

    }).each(function() { form.append(this); })

    var languages = $(this).children().map(function() {
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
    $(this).prepend(panel);
  });
  
  filterDidChange(filter);
});
