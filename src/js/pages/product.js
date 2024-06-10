$(function() {
  const cart = new Cart();
  cart.init();

  const slug = $('#add-cart').attr('data-slug');

  if (cart.cart.find(p => p.slug === slug)) {
    $('#add-cart').text('Ver no Carrinho');
    $('#add-cart').on('click', function() {
      window.location.href = BASE_URL + 'carrinho'
    });
  } else {
    $('#add-cart').on('click', function() {
      $.ajax({
        url: BASE_URL + 'projetos/project?slug=' + slug,
        dataType: 'json',
        success: (json) => {
          if (json.data.is_logged === 0) {
            window.location.href = BASE_URL + 'conta/';
            return;
          }

          cart.pushProject(json.data);

          $('#add-cart').text('Ver no Carrinho');
          $('#add-cart').on('click', function() {
            window.location.href = BASE_URL + 'carrinho'
          });
        },
      });
    });
  }

  $('#slick-product-images').slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
  });

  $('#dots-product').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    infinite: false,
    asNavFor: '#slick-product-images',
    focusOnSelect: true,
  });
});