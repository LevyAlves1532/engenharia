$(function() {
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
    dots: true,
    focusOnSelect: true,
  });
});