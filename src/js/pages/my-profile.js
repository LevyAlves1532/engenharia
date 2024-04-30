$(function() {
  $('#tab-box-my-profile .MyProfileTabBox__tabs button').on('click', function() {
    const tab = $(this).attr('data-tab');
    const tabActiveClass = 'active-tab';

    $('#tab-box-my-profile .MyProfileTabBox__tabs button').removeClass(tabActiveClass);
    $('#tab-box-my-profile .MyProfileTabBox__content_item').removeClass(tabActiveClass);
    $(`#tab-box-my-profile div[data-tab-name="${tab}"]`).addClass(tabActiveClass);
    $(this).addClass(tabActiveClass);
  });
});