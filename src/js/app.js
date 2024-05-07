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

  // Open cart in menu
  $('.button-cart-open').on('click', function() {
    const headerCart = $('.HeaderCart');
    const headerCartActiveClass = 'HeaderCart--active';

    if (!headerCart.hasClass(headerCartActiveClass)) {
      headerCart.addClass(headerCartActiveClass);
    } else {
      headerCart.removeClass(headerCartActiveClass);
    }
  });

  // Close cart when the mouse leave cart
  $('.button-cart-open').parent().on('mouseleave', function() {
    $('.HeaderCart').removeClass('HeaderCart--active');
  });

  // Close cart when click in the button close on menu
  $('.HeaderCartIcon__close').on('click', function() {
    $('.HeaderCart').removeClass('HeaderCart--active');
  });
  /**
   * Header Script - End
   */

  /**
   * Input Script - Start
   */
  // Visible password
  $('input[type="password"]').parent().parent().find('button').on('click', function() {
    const contentParent = $(this).parent();
    const input = contentParent.find('input');
    const svg = $(this).find('svg');
    const isPassword = input.attr('type') === 'password';
    input.attr('type', isPassword ? 'text' : 'password');
    $(svg[0]).css('display', isPassword ? 'none' : 'block');
    $(svg[1]).css('display', isPassword ? 'block' : 'none');
  });
  /**
   * Input Script - End
   */

  /**
   * Menu admin - Start
   */
  $('#open-menu-admin').on('click', function() {
    $('.AdminTemplate__body_menu-bar').addClass('AdminTemplate__body_menu-bar--active');
  });

  $('.AdminTemplate__body_menu-bar').on('click', function(e) {
    const activeMenuAdmClass = 'AdminTemplate__body_menu-bar--active';

    if ($(e.target).hasClass(activeMenuAdmClass)) {
      $(e.target).removeClass(activeMenuAdmClass);
    }
  });
  /**
   * Menu admin - End
   */
})
