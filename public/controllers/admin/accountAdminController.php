<?php

class accountAdminController extends controller
{
  public function index()
  {
    $data = [];

    if (!empty($_SESSION['user_admin'])) {
      $user_admin = $_SESSION['user_admin'];
      $permissions = json_decode($user_admin['permissions']);

      if (!property_exists($permissions, 'users')) {
        unset($_SESSION['user_admin']);
        header('Location: ' . BASE . 'admin/');
      }

      if (!in_array('UPDATE', $permissions->users)) {
        unset($_SESSION['user_admin']);
        header('Location: ' . BASE . 'admin/');
      }
    } else {
      header('Location: ' . BASE . 'admin/account/sign_in');
    }

    $users = new Users();
    $user = null;

    if (!empty($_SESSION['user_admin'])) {
      $user = $_SESSION['user_admin']['id'];
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

      if ($user !== []) {
        $_SESSION['user_admin'] = $user;
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
    header('Location: ' . BASE . 'admin/');
  }
}
