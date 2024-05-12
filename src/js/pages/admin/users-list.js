$(function() {
  const href = window.location.href;

  if (href.indexOf('/admin/users') > -1 && href.indexOf('/admin/users/form') === -1) {
    $('#users-table').DataTable({
      ajax: BASE_URL + 'admin/users/list',
      processing: true,
      serverSide: true,
      language: {
        url: 'https://cdn.datatables.net/plug-ins/2.0.7/i18n/pt-BR.json',
      },
    });
  }
});