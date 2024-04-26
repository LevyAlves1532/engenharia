$(function() {
  /**
   * Header Script - Start
   */
  // setTimeout(() => socialPosition(), 500);

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

  // $(window).on('resize', socialPosition);

  // function socialPosition() {
  //   if (window.screen.width <= 768) {
  //     const heightHeader = $('.Header').height();

  //     console.log(heightHeader);
  //     $('.HeaderMenu nav').css('height', `${window.screen.height - heightHeader}px`);
  //   } else {
  //     $('.HeaderMenu nav').attr('style', '');
  //   }
  // }
  /**
   * Header Script - End
   */
})
