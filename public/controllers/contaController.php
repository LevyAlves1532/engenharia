<?php

class contaController extends controller {
  public function index()
  {
    if (!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])) {
      $this->loadTemplate('account-form');
    }
  }

  public function criar_conta()
  {
    $ajax_return = [];

    $users = new Users();

    if (
      !empty($_POST['name']) && 
      !empty($_POST['email']) && 
      !empty($_POST['password'])
    ) {
      $name = addslashes($_POST['name']);
      $email = addslashes($_POST['email']);
      $password = addslashes($_POST['password']);

      $users->set($name, $email, $password, 2, 1);

      $ajax_return['data'] = 'Você foi criado com sucesso!';
    } else {
      $ajax_return['error'] = 'Preencha os campos corretamente!';
    }

    echo json_encode($ajax_return);
  }

  public function logar()
  {
    $ajax_return = [];

    $users = new Users();

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
      $email = addslashes($_POST['email']);
      $password = addslashes($_POST['password']);

      $user = $users->getWithEmailAndPass($email, $password);

      if ($user !== []) {
        $_SESSION['user'] = $user;

        $ajax_return['data'] = 'Usuário logado!';
      } else {
        $ajax_return['error'] = 'Nenhum usuário encontrado!';  
      }
    } else {
      $ajax_return['error'] = 'Preencha os campos corretamente!';
    }

    echo json_encode($ajax_return);
  }
}
