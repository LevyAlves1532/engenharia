$(function() {
  const cart = new Cart();
  cart.init();

  $('#buy-projects').on('click', function() {
    $.ajax({
      url: BASE_URL + 'carrinho/comprar',
      method: 'POST',
      dataType: 'json',
      success: (json) => {
        if (json.error) {
          localStorage.setItem(GO_CHECKOUT_STORAGE, 'true');
          window.location.href = BASE_URL + 'conta';
          return;
        }

        window.location.href = BASE_URL + 'checkout';
      },
    })
  });
})
