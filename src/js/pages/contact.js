$(function() {
  $('.ContactFaqItem .ContactFaqItem__button').on('click', function() {
    const el = $(this).parent();
    const contactFaqActiveClass = 'ContactFaqItem--active';
    
    if (!el.hasClass(contactFaqActiveClass)) {
      $('.ContactFaqItem').removeClass(contactFaqActiveClass);
      $('.ContactFaqItem__content').css('height', '0');

      el.addClass(contactFaqActiveClass);
      el.find('.ContactFaqItem__content').css('height', `${el.find('.ContactFaqItem__content_body').height() + 40}px`);
    } else {
      el.removeClass(contactFaqActiveClass);
      el.find('.ContactFaqItem__content').css('height', '0');
    }
  });
});