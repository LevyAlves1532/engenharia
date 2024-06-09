$(function() {
  const href = window.location.href;

  if (href.indexOf('/admin/reimbursement') > -1 && href.indexOf('/admin/reimbursement/view') === -1) {
    $('#reimbursement-table').DataTable({
      ajax: BASE_URL + 'admin/reimbursement/list',
      processing: true,
      serverSide: true,
      language: {
        url: 'https://cdn.datatables.net/plug-ins/2.0.7/i18n/pt-BR.json',
      },
    });
  }
});
