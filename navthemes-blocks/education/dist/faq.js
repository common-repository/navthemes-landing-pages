// Toggle Collapse
jQuery(function() {
  jQuery('.educationfaq-questioncontainer').on('click', function(e) {
    e.preventDefault();
    if (jQuery(this).hasClass('active')) {
      jQuery(this).removeClass('active');
      jQuery(this).next()
      .stop()
      .slideUp(300);
    } else {
      jQuery(this).addClass('active');
      jQuery(this).next()
      .stop()
      .slideDown(300);
    }
  });
});