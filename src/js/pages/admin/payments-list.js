$(function() {
  const href = window.location.href;

  if (href.indexOf('/admin/payments') > -1 && href.indexOf('/admin/payments/view') === -1) {
    $('#payments-table').DataTable({
      ajax: BASE_URL + 'admin/payments/list',
      processing: true,
      serverSide: true,
      language: {
        url: 'https://cdn.datatables.net/plug-ins/2.0.7/i18n/pt-BR.json',
      },
    });
  }
})