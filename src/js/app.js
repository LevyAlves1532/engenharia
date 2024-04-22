$(function() {
  /**
   * Header Script - Start
   */
  $('#button-menu').on('click', function(el) {
    const activeHeaderClass = 'Header--active';
    const headerEl = $('.Header');

    if (!headerEl.hasClass(activeHeaderClass)) {
      headerEl.addClass(activeHeaderClass);
    } else {
      headerEl.removeClass(activeHeaderClass);
    }
  });
  /**
   * Header Script - End
   */
})
