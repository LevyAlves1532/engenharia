$(function() {
  const href = window.location.href;

  if (href.indexOf('/admin/faq') > -1 && href.indexOf('/admin/faq/form') === -1) {
    $('#faq-table').DataTable({
      ajax: BASE_URL + 'admin/faq/list',
      processing: true,
      serverSide: true,
      language: {
        url: 'https://cdn.datatables.net/plug-ins/2.0.7/i18n/pt-BR.json',
      },
    });
  }
});
