<?php

class meu_perfilController extends controller {
  public function index()
  {
    $data = [];

    $users = new Users();

    if (empty($_SESSION['user'])) {
      header('Location: ' . BASE);
    }

    $data['user'] = $users->get($_SESSION['user']['id']);

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
}
