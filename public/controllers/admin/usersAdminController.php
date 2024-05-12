<?php

class usersAdminController extends controller {
  public function index()
  {
    $this->loadTemplateAdmin('users-list');
  }

  public function form($id = null)
  {
    $data = [];

    $user_types = new UserTypes();
    $users = new Users();

    $all = $user_types->getAll();
    $data['types'] = $all;

    if (!empty($id)) {
      $id_decoded = base64_decode($id);
      $user = $users->get($id_decoded);

      $data['user'] = $user;
      $data['id'] = $id;
    }

    $this->loadTemplateAdmin('users-form', $data);
  }

  public function list()
  {
    $users = new Users();
    $ajax_return = [];

    $all = $users->getAll($_GET);
    $count = $users->getCount($_GET['search']['value']);

    function filter($user) {
      return [
        $user['name'], 
        $user['email'], 
        $user['type'], 
        '
          <div class="dropdown">
            <button class="btn btn-outline-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ações
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="' . BASE . 'admin/users/form/' . base64_encode($user['id']) . '">Editar</a></li>
              <li><a class="dropdown-item" href="' . BASE . 'admin/users/delete/' . base64_encode($user['id']) . '">Deletar</a></li>
            </ul>
          </div>
        '
      ];
    }

    $ajax_return['draw'] = intval($_GET['draw']);
    $ajax_return['recordsTotal'] = $count['qtd_users'];
    $ajax_return['recordsFiltered'] = $count['qtd_users'];
    $ajax_return['data'] = array_map('filter', $all);

    echo json_encode($ajax_return);
  }

  public function add()
  {
    $users = new Users();

    if (
      !empty($_POST['name']) && 
      !empty($_POST['email']) && 
      !empty($_POST['password']) && 
      !empty($_POST['user_type'])
    ) {
      $name = addslashes($_POST['name']);
      $email = addslashes($_POST['email']);
      $password = addslashes($_POST['password']);
      $user_type = addslashes(base64_decode($_POST['user_type']));

      $users->set($name, $email, $password, $user_type, 1);

      // $this->mail->setFrom('levy.pereiraA1532@gmail.com', 'Lêvy Alves');
      // $this->mail->addAddress('soloplayerpe299@gmail.com', 'Solo Player');

      // $this->mail->isHTML(true);
      // $this->mail->Subject = 'Cadastro de usuário';
      // $this->mail->Body = 'Conteúdo do E-mail em HTML';
    } else {
      $this->array_ajax['status'] = false;
      $this->array_ajax['return'] = ['error' => 'Está faltando parâmetros!'];
    }
    echo json_encode($this->array_ajax);
  }

  public function edit()
  {
    $users = new Users();

    if (
      !empty($_POST['iu']) && 
      ( 
        !empty($_POST['name']) || 
        !empty($_POST['email']) || 
        !empty($_POST['password']) || 
        !empty($_POST['user_type'])
      )
    ) {
      $post = $_POST;
      array_shift($post);

      $id = addslashes(base64_decode($_POST['iu']));

      $keys_post = array_keys($post);

      $users->up($id, $keys_post, $post);
    } else {
      $this->array_ajax['status'] = false;
      $this->array_ajax['return'] = ['error' => 'Está faltando parâmetros!'];
    }

    echo json_encode($this->array_ajax);
  }

  public function delete($id)
  {
    if (!empty($id)) {
      $id_decoded = base64_decode($id);

      $users = new Users();
      $users->delete($id_decoded);
    }

    header('Location: ' . BASE . 'admin/users');
  }
}
