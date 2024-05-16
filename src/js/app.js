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

function validateForm(form, inputsName, validateFunc) {
  let isValid = true;

  const formData = new FormData(form);
  
  inputsName.forEach(inputName => {
    const element = document.querySelector(`input[name="${inputName}"]`) || document.querySelector(`select[name="${inputName}"]`)
    || document.querySelector(`textarea[name="${inputName}"]`);
    const validInput = validateFunc[inputName](formData.get(inputName), element);
    if (validInput.error) isValid = false;

    showError(element, validInput.label);
  });

  return isValid;
}

function showError(element, label) {
  const main = element.type === 'password' ? $(element).parent().parent() : $(element).parent();
  const errorDiv = main.find('.error');

  if (label) {
    errorDiv.html(`<p class="text-danger mt-2">${label}</p>`);
  } else {
    errorDiv.html('');
  }
}

function clearInputs(form, inputsName, validateFunc) {
  const formData = new FormData(form);
  let isValid = true;

  inputsName.forEach(inputName => {
    const value = formData.get(inputName);
    
    if (typeof value === "string" && (value.trim() === "" || value.trim() === "null")) {
      formData.delete(inputName);
    } else if (typeof value === "object" && (value.name === "" && value.size === 0)) {
      formData.delete(inputName);
    } else {
      const element = document.querySelector(`input[name="${inputName}"]`) || document.querySelector(`select[name="${inputName}"]`)
        || document.querySelector(`textarea[name="${inputName}"]`);;
      const validInput = validateFunc[inputName](value, element);
      if (validInput.error) isValid = false;

      showError(element, validInput.label);
    }
  });

  return isValid ? formData : null;
}

function convertInBRL(number) {
  return number.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}
