$(function() {
  const href = window.location.href;

  if (href.indexOf('/admin/posts_instagram') > -1 && href.indexOf('/admin/posts_instagram/form') === -1) {
    $('#posts-instagram-table').DataTable({
      ajax: BASE_URL + 'admin/posts_instagram/list',
      processing: true,
      serverSide: true,
      language: {
        url: 'https://cdn.datatables.net/plug-ins/2.0.7/i18n/pt-BR.json',
      },
    });
  }
});
