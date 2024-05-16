$(function() {
  const href = window.location.href;

  if (href.indexOf('/admin/projects') > -1 && href.indexOf('/admin/projects/form') === -1) {
    $('#projects-table').DataTable({
      ajax: BASE_URL + 'admin/projects/list',
      processing: true,
      serverSide: true,
      language: {
        url: 'https://cdn.datatables.net/plug-ins/2.0.7/i18n/pt-BR.json',
      },
    });
  }
});
