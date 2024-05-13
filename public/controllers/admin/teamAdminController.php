<?php

class teamAdminController extends controller {
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
        $extension = explode('/', $photo['type'])[1];
        $photo_name = md5(date('Y-m-d H:i:s') . round(0, 9999)) . '.' . $extension;

        $folder_name = date('Y-m-d');
        $path = 'assets/images/' . $folder_name;

        if (!file_exists($path)) {
          mkdir($path);
        }

        $path = $path . '/' . $photo_name;
        move_uploaded_file($photo['tmp_name'], $path);

        $path = BASE . $path;
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
          $path_photo_old = parse_url($person_team['photo'], PHP_URL_PATH); // Extrair o caminho da URL
          $filename_with_dir = basename($path_photo_old); // Obter a parte final do caminho (nome do arquivo com diretório)
          $parent_dir = dirname($path_photo_old); // Obter o diretório pai do arquivo
          $last_two_parts = '/' . substr($parent_dir, strrpos($parent_dir, '/') + 1) . '/' . $filename_with_dir; // Obter as duas últimas partes

          if (file_exists('assets/images' . $last_two_parts)) {
            unlink('assets/images' . $last_two_parts);
          }

          $extension = explode('/', $photo['type'])[1];
          $photo_name = md5(date('Y-m-d H:i:s') . round(0, 9999)) . '.' . $extension;
  
          $folder_name = date('Y-m-d');
          $path = 'assets/images/' . $folder_name;
  
          if (!file_exists($path)) {
            mkdir($path);
          }
  
          $path = $path . '/' . $photo_name;
          move_uploaded_file($photo['tmp_name'], $path);
  
          $path = BASE . $path;
          $post['photo'] = $path;
          $keys_post = array_keys($post);
          $team->up($id, $keys_post, $post);
          exit;
        } else {
          $this->array_ajax['status'] = false;
          $this->array_ajax['return'] = ['error' => 'Arquivo inválido!'];  
        }
      } else {
        $keys_post = array_keys($post);
        $team->up($id, $keys_post, $post);
        exit;
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

      $path_photo_old = parse_url($person_team['photo'], PHP_URL_PATH); // Extrair o caminho da URL
      $filename_with_dir = basename($path_photo_old); // Obter a parte final do caminho (nome do arquivo com diretório)
      $parent_dir = dirname($path_photo_old); // Obter o diretório pai do arquivo
      $last_two_parts = '/' . substr($parent_dir, strrpos($parent_dir, '/') + 1) . '/' . $filename_with_dir; // Obter as duas últimas partes

      if (file_exists('assets/images' . $last_two_parts)) {
        unlink('assets/images' . $last_two_parts);
      }
    }

    header('Location: ' . BASE . 'admin/team');
  }
}
