<?php

class reimbursementAdminController extends controller {
  private $permissions_user_reimbursement = [];

  public function __construct()
  {
    if (!empty($_SESSION['user_admin']) && empty($_COOKIE['user_admin'])) {
      $user_admin = $_SESSION['user_admin'];
      $permissions = json_decode($user_admin['permissions']);

      if (!property_exists($permissions, 'reimbursement')) {
        unset($_SESSION['user_admin']);
        header('Location: ' . BASE . 'admin/');
      }

      $this->permissions_user_reimbursement = $permissions->reimbursement;
    } else {
      header('Location: ' . BASE . 'admin/account/sign_in');
    }
  }

  public function index()
  {
    if (!in_array('READ', $this->permissions_user_reimbursement)) {
      header('Location: ' . BASE . 'admin/');
      exit;
    }

    $this->loadTemplateAdmin('reimbursement-list');
  }

  public function list()
  {
    $reimbursement = new Reimbursement();
    $ajax_return = [];

    $all = $reimbursement->getAll($_GET);
    $count = $reimbursement->getCount($_GET['search']['value']);

    function filter($reimbursement_item) {
      $reimbursement = new Reimbursement();

      return [
        $reimbursement_item['name'], 
        $reimbursement_item['phone'], 
        $reimbursement->getStatus($reimbursement_item['status']), 
        '
          <div class="dropdown">
            <button class="btn btn-outline-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ações
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="' . BASE . 'admin/reimbursement/view/' . base64_encode($reimbursement_item['id']) . '">Ver Processo</a></li>
            </ul>
          </div>
        '
      ];
    }

    $ajax_return['draw'] = intval($_GET['draw']);
    $ajax_return['recordsTotal'] = $count['qtd_reimbursement'];
    $ajax_return['recordsFiltered'] = $count['qtd_reimbursement'];
    $ajax_return['data'] = array_map('filter', $all);

    echo json_encode($ajax_return);
  }

  public function view($id = null)
  {
    if (!in_array('READ', $this->permissions_user_reimbursement)) {
      header('Location: ' . BASE . 'admin/reimbursement');
      exit;
    }

    $data = [];

    $reimbursement = new Reimbursement();

    if (!empty($id)) {
      $id_decoded = addslashes(base64_decode($id));
      
      $data['reimbursement'] = $reimbursement->get($id_decoded);
    }

    $this->loadTemplateAdmin('reimbursement-view', $data);
  }

  public function edit()
  {
    $payments = new Payments();
    $reimbursement = new Reimbursement();

    if (isset($_POST['status']) && !empty($_POST['response']) && !empty($_POST['ir'])) {
      $status = addslashes($_POST['status']);
      $response = addslashes($_POST['response']);
      $id_reimbursement = addslashes(base64_decode($_POST['ir']));

      $reimbursement_item = $reimbursement->get($id_reimbursement);

      if ($status === '1') {
        $payments->up('refunded', $reimbursement_item['id_payment']);
      } else {
        $payment = $payments->get($reimbursement_item['id_payment']);
        $mp_json = json_decode($payment['mp_json']);
        $payments->up($mp_json->status, $reimbursement_item['id_payment']);
      }

      $reimbursement->up($response, $status, $id_reimbursement);
      
      $this->array_ajax['status'] = true;
      $this->array_ajax['return'] = 'Reembolso alterado com sucesso!';
    } else {
      $this->array_ajax['status'] = false;
      $this->array_ajax['return'] = 'Está faltando parâmetros na requisição!';
    }

    echo json_encode($this->array_ajax);
  }
}
