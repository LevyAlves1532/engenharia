<?php

class teamAdminController extends controller {
  public function __construct()
  {
    if (empty($_SESSION['user_admin']) && empty($_COOKIE['user_admin'])) {
      header('Location: ' . BASE . 'admin/account/sign_in');
    }
  }

  public function index()
  {
    $this->loadTemplateAdmin('team-list');
  }

  public function form($id = null)
  {
    $data = [];

    $team = new Team();

    if (!empty($id)) {
      $id_decoded = base64_decode($id);
      $person_team = $team->get($id_decoded);
      
      $data['team'] = $person_team;
      $data['id'] = $id;
    }

    $this->loadTemplateAdmin('team-form', $data);
  }

  public function list()
  {
    $team = new Team();
    $ajax_return = [];

    $all = $team->getAll($_GET);
    $count = $team->getCount($_GET['search']['value']);

    function filter($team) {
      return [
        '
          <img src="' . $team['photo'] . '" width="50" height="50" class="rounded" alt="" />
        ', 
        $team['name'], 
        $team['profession'], 
        '
          <div class="dropdown">
            <button class="btn btn-outline-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ações
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="' . BASE . 'admin/team/form/' . base64_encode($team['id']) . '">Editar</a></li>
              <li><a class="dropdown-item" href="' . BASE . 'admin/team/delete/' . base64_encode($team['id']) . '">Deletar</a></li>
            </ul>
          </div>
        '
      ];
    }

    $ajax_return['draw'] = intval($_GET['draw']);
    $ajax_return['recordsTotal'] = $count['qtd_team'];
    $ajax_return['recordsFiltered'] = $count['qtd_team'];
    $ajax_return['data'] = array_map('filter', $all);

    echo json_encode($ajax_return);
  }

  public function add()
  {
    $team = new Team();

    if (
      !empty($_FILES['photo']) && 
      !empty($_POST['name']) && 
      !empty($_POST['profession'])
    ) {
      $photo = $_FILES['photo'];
      $name = addslashes($_POST['name']);
      $profession = addslashes($_POST['profession']);

      if (!empty($photo['tmp_name'])) {
        $path = uploadFile($photo);
        $team->set($path, $name, $profession);

        $this->array_ajax['return'] = ['data' => 'Pessoa adicionado ao time com sucesso!'];
      } else {
        $this->array_ajax['status'] = false;
        $this->array_ajax['return'] = ['error' => 'Arquivo inválido!'];  
      }
    } else {
      $this->array_ajax['status'] = false;
      $this->array_ajax['return'] = ['error' => 'Está faltando parâmetros!'];
    }
    echo json_encode($this->array_ajax);
  }

  public function edit()
  {
    $team = new Team();

    if (
      !empty($_POST['it']) && 
      ( 
        !empty($_FILES['photo']) || 
        !empty($_POST['name']) || 
        !empty($_POST['profession'])
      )
    ) {
      $post = $_POST;
      array_shift($post);

      $id = addslashes(base64_decode($_POST['it']));
      $person_team = $team->get($id);

      if (!empty($_FILES['photo'])) {
        $photo = $_FILES['photo'];

        if (!empty($photo['tmp_name'])) {
          deleteFile($person_team['photo']);  
          $path = uploadFile($photo);

          $post['photo'] = $path;
          $keys_post = array_keys($post);
          $team->up($id, $keys_post, $post);

          $this->array_ajax['return'] = ['path' => $path];
        } else {
          $this->array_ajax['status'] = false;
          $this->array_ajax['return'] = ['error' => 'Arquivo inválido!'];  
        }
      } else {
        $keys_post = array_keys($post);
        $team->up($id, $keys_post, $post);
        $this->array_ajax['status'] = true;
      }
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

      $team = new Team();
      $person_team = $team->delete($id_decoded);
      deleteFile($person_team['photo']);
    }

    header('Location: ' . BASE . 'admin/team');
  }
}
