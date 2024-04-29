$(function() {
  /**
   * Header Script - Start
   */
  // Switch button menu mobile
  $('#button-menu').on('click', function(el) {
    const activeHeaderClass = 'Header--active';
    const headerEl = $('.Header');

    if (!headerEl.hasClass(activeHeaderClass)) {
      headerEl.addClass(activeHeaderClass);
    } else {
      headerEl.removeClass(activeHeaderClass);
    }
  });

  // Active Link Menu
  $('.HeaderMenuList li').each(function(index, linkMenu) {
    const href = window.location.href.replace(BASE_URL, "");
    const hrefLink = $(linkMenu).find('a').attr('href').replace(BASE_URL, "");

    const activeLinkMenu = 'active-link-menu';

    if (href.length !== 0 && href.indexOf(hrefLink) > -1) {
      $('.HeaderMenuList li').removeClass(activeLinkMenu);
      $(linkMenu).addClass(activeLinkMenu);
    } else if (href.length === 0 && hrefLink.length === 0) {
      $('.HeaderMenuList li').removeClass(activeLinkMenu);
      $(linkMenu).addClass(activeLinkMenu);
    }
  });

  $('.button-cart-open').on('click', function() {
    const headerCart = $('.HeaderCart');
    const headerCartActiveClass = 'HeaderCart--active';

    if (!headerCart.hasClass(headerCartActiveClass)) {
      headerCart.addClass(headerCartActiveClass);
    } else {
      headerCart.removeClass(headerCartActiveClass);
    }
  });

  $('.button-cart-open').parent().on('mouseleave', function() {
    $('.HeaderCart').removeClass('HeaderCart--active');
  });

  $('#button-cart-close').on('click', function() {
    $('.HeaderCart').removeClass('HeaderCart--active');
  });
  /**
   * Header Script - End
   */
})
