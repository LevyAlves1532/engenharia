<?php

class paymentsAdminController extends controller {
  public function __construct()
  {
    if (empty($_SESSION['user_admin']) && empty($_COOKIE['user_admin'])) {
      header('Location: ' . BASE . 'admin/account/sign_in');
    }
  }

  public function index()
  {
    $this->loadTemplateAdmin('payments-list');
  }

  public function view($id)
  {
    $data = [];

    $payments = new Payments();

    if (!empty($id)) {
      $id_decoded = addslashes(base64_decode($id));

      $data['payment'] = $payments->get($id_decoded);

      $this->loadTemplateAdmin('payments-view', $data);
    } else {
      header('Location ' . BASE . 'admin/payments');
    }
  }

  public function list()
  {
    $payments = new Payments();
    $ajax_return = [];

    $all = $payments->getAll($_GET);
    $count = $payments->getCount($_GET['search']['value']);

    function filter($payment) {
      return [
        $payment['name'], 
        $payment['card_bank'], 
        'R$ ' . number_format($payment['total_value'], 2, ',', '.'), 
        '
          <div class="dropdown">
            <button class="btn btn-outline-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ações
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="' . BASE . 'admin/payments/view/' . base64_encode($payment['id']) . '">Visualizar</a></li>
            </ul>
          </div>
        '
      ];
    }

    $ajax_return['draw'] = intval($_GET['draw']);
    $ajax_return['recordsTotal'] = $count['qtd_payments'];
    $ajax_return['recordsFiltered'] = $count['qtd_payments'];
    $ajax_return['data'] = array_map('filter', $all);

    echo json_encode($ajax_return);
  }
}
