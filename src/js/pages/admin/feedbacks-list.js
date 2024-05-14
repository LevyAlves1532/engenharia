$(function() {
  const href = window.location.href;

  if (href.indexOf('/admin/feedbacks') > -1 && href.indexOf('/admin/feedbacks/form') === -1) {
    $('#feedbacks-table').DataTable({
      ajax: BASE_URL + 'admin/feedbacks/list',
      processing: true,
      serverSide: true,
      language: {
        url: 'https://cdn.datatables.net/plug-ins/2.0.7/i18n/pt-BR.json',
      },
    });
  }
});
