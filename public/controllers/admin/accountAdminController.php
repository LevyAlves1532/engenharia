<?php

class accountAdminController extends controller
{
  public function index()
  {
    $data = [];

    if (empty($_SESSION['user_admin']) && empty($_COOKIE['user_admin'])) {
      header('Location: ' . BASE . 'admin/account/sign_in');
    }

    $users = new Users();
    $user = null;

    if (!empty($_SESSION['user_admin'])) {
      $user = $_SESSION['user_admin'];
    } else {
      $user = $_COOKIE['user_admin'];
    }

    $data['user'] = $users->get($user);
    
    $this->loadTemplateAdmin('my-profile', $data);
  }

  public function sign_in()
  {
    $this->loadView('admin/sign-in');
  }

  public function login()
  {
    $users = new Users();

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
      $email = addslashes($_POST['email']);
      $password = addslashes($_POST['password']);

      $user = $users->getWithEmailAndPass($email, $password);

      if (!empty($_POST['remember'])) {
        setcookie('user_admin', $user['id'], time() + (86400 * 7));
      }

      if ($user !== []) {
        $_SESSION['user_admin'] = $user['id'];
      } else {
        $this->array_ajax['status'] = false;
        $this->array_ajax['return'] = ['error' => 'E-mail ou senha estão incorretos!'];  
      }
    } else {
      $this->array_ajax['status'] = false;
      $this->array_ajax['return'] = ['error' => 'Está faltando parâmetros!'];
    }

    echo json_encode($this->array_ajax);
  }

  public function logout()
  {
    unset($_SESSION['user_admin']);
    unset($_COOKIE['user_admin']);
    header('Location: ' . BASE . 'admin/');
  }
}
