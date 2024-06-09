<?php

class meu_perfilController extends controller {
  public function index()
  {
    $data = [];

    $users = new Users();
    $payments = new Payments();
    $reimbursement = new Reimbursement();

    if (empty($_SESSION['user'])) {
      header('Location: ' . BASE);
    }

    $data['user'] = $users->get($_SESSION['user']['id']);
    $data['payments'] = $payments->getAllFromIdUser($_SESSION['user']['id']);

    foreach($data['payments'] as $key => $payment) {
      $data['payments'][$key]['reimbursement'] = $reimbursement->getFromIdUserAndIdPayment($_SESSION['user']['id'], $payment['id']);
    }

    $this->loadTemplate('my-profile', $data);
  }

  public function editar_perfil()
  {
    $ajax_return = [];

    $users = new Users();

    if (
      !empty($_POST['name']) || 
      !empty($_POST['email']) || 
      !empty($_POST['password'])
    ) {
      $post = $_POST;

      $id = $_SESSION['user']['id'];
      
      $keys_post = array_keys($post);

      $users->up($id, $keys_post, $post);

      foreach($keys_post as $key) {
        $_SESSION['user'][$key] = $post[$key];
      }

      $array_ajax['data'] = 'Perfil editado com sucesso!';
    } else {
      $array_ajax['error'] = 'Está faltando parâmetros!';
    }

    echo json_encode($ajax_return);
  }

  public function sair()
  {
    unset($_SESSION['user']);
    header('Location: ' . BASE);
  }

  public function reembolso($id_project = null)
  {
    $data = [];

    if (!empty($id_project)) {
      $data['id_project'] = $id_project;
    } else {
      header('Location: ' . BASE . 'meu_perfil?tab=historic');
    }

    $this->loadTemplate('reimbursement', $data);
  }

  public function solicitar_reembolso()
  {
    $ajax_return = [];

    $reimbursement = new Reimbursement();

    if (
      !empty($_POST['ip']) && 
      !empty($_POST['phone']) && 
      !empty($_POST['motive'])
    ) {
      $id_payment = addslashes(base64_decode($_POST['ip']));
      
      if (!$reimbursement->is_request($_SESSION['user']['id'], $id_payment)) {
        $phone = addslashes($_POST['phone']);
        $motive = addslashes($_POST['motive']);

        $reimbursement->set($_SESSION['user']['id'], $id_payment, $phone, $motive);

        $ajax_return['data'] = 'Reembolso solicitado com sucesso';
      } else {
        $ajax_return['error'] = 'Você já fez uma solicitação, aguarde o contato!';
      }
    } else {
      $ajax_return['error'] = 'Está faltando paramêtros na requisição';
    }

    echo json_encode($ajax_return);
  }

  public function ver_reembolso($id = null)
  {
    $data = [];

    $reimbursement = new Reimbursement();

    if (!empty($id)) {
      $id_decoded = base64_decode($id);
      $data['reimbursement'] = $reimbursement->get($id_decoded);
      if (empty($data['reimbursement'])) header('Location: ' . BASE . 'meu_perfil?tab=historic');
    } else {
      header('Location: ' . BASE . 'meu_perfil?tab=historic');
    }

    $this->loadTemplate('view-reimbursement', $data);
  }
}
