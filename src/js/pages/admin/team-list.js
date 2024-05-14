$(function() {
  const href = window.location.href;

  if (href.indexOf('/admin/team') > -1 && href.indexOf('/admin/team/form') === -1) {
    $('#team-table').DataTable({
      ajax: BASE_URL + 'admin/team/list',
      processing: true,
      serverSide: true,
      language: {
        url: 'https://cdn.datatables.net/plug-ins/2.0.7/i18n/pt-BR.json',
      },
    });
  }
});
