<?php

class feedbacksAdminController extends controller {
  public function index()
  {
    $this->loadTemplateAdmin('feedbacks-list');
  }

  public function form($id = null)
  {
    $data = [];

    $feedbacks = new Feedbacks();

    if (!empty($id)) {
      $id_decoded = base64_decode($id);
      $feedback = $feedbacks->get($id_decoded);

      $data['feedback'] = $feedback;
      $data['id'] = $id;
    }

    $this->loadTemplateAdmin('feedbacks-form', $data);
  }

  public function list()
  {
    $feedbacks = new Feedbacks();
    $ajax_return = [];

    $all = $feedbacks->getAll($_GET);
    $count = $feedbacks->getCount($_GET['search']['value']);

    function filter($feedback) {
      return [
        '
          <img src="' . $feedback['cover'] . '" width="50" height="50" class="rounded" alt="" />
        ', 
        $feedback['name'], 
        $feedback['assessment'], 
        '
          <div class="dropdown">
            <button class="btn btn-outline-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ações
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="' . BASE . 'admin/feedbacks/form/' . base64_encode($feedback['id']) . '">Editar</a></li>
              <li><a class="dropdown-item" href="' . BASE . 'admin/feedbacks/delete/' . base64_encode($feedback['id']) . '">Deletar</a></li>
            </ul>
          </div>
        '
      ];
    }

    $ajax_return['draw'] = intval($_GET['draw']);
    $ajax_return['recordsTotal'] = $count['qtd_feedbacks'];
    $ajax_return['recordsFiltered'] = $count['qtd_feedbacks'];
    $ajax_return['data'] = array_map('filter', $all);

    echo json_encode($ajax_return);
  }

  public function add()
  {
    $feedbacks = new Feedbacks();

    if (
      !empty($_FILES['cover']) && 
      !empty($_POST['name']) && 
      !empty($_POST['assessment']) &&
      !empty($_POST['short_description'])
    ) {
      $cover = $_FILES['cover'];
      $name = addslashes($_POST['name']);
      $assessment = addslashes($_POST['assessment']);
      $short_description = addslashes($_POST['short_description']);

      if (!empty($cover['tmp_name'])) {
        $extension = explode('/', $cover['type'])[1];
        $cover_name = md5(date('Y-m-d H:i:s') . round(0, 9999)) . '.' . $extension;

        $folder_name = date('Y-m-d');
        $path = 'assets/images/' . $folder_name;

        if (!file_exists($path)) {
          mkdir($path);
        }

        $path = $path . '/' . $cover_name;
        move_uploaded_file($cover['tmp_name'], $path);

        $path = BASE . $path;
        $feedbacks->set($path, $name, $assessment, $short_description);

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
    $feedbacks = new Feedbacks();

    if (
      !empty($_POST['if']) && 
      ( 
        !empty($_FILES['cover']) || 
        !empty($_POST['name']) || 
        !empty($_POST['assessment']) ||
        !empty($_POST['short_description'])
      )
    ) {
      $post = $_POST;
      array_shift($post);

      $id = addslashes(base64_decode($_POST['if']));
      $feedback = $feedbacks->get($id);

      if (!empty($_FILES['cover'])) {
        $cover = $_FILES['cover'];

        if (!empty($cover['tmp_name'])) {
          $path_cover_old = parse_url($feedback['cover'], PHP_URL_PATH); // Extrair o caminho da URL
          $filename_with_dir = basename($path_cover_old); // Obter a parte final do caminho (nome do arquivo com diretório)
          $parent_dir = dirname($path_cover_old); // Obter o diretório pai do arquivo
          $last_two_parts = '/' . substr($parent_dir, strrpos($parent_dir, '/') + 1) . '/' . $filename_with_dir; // Obter as duas últimas partes

          if (file_exists('assets/images' . $last_two_parts)) {
            unlink('assets/images' . $last_two_parts);
          }

          $extension = explode('/', $cover['type'])[1];
          $cover_name = md5(date('Y-m-d H:i:s') . round(0, 9999)) . '.' . $extension;
  
          $folder_name = date('Y-m-d');
          $path = 'assets/images/' . $folder_name;
  
          if (!file_exists($path)) {
            mkdir($path);
          }
  
          $path = $path . '/' . $cover_name;
          move_uploaded_file($cover['tmp_name'], $path);
  
          $path = BASE . $path;
          $post['cover'] = $path;
          $keys_post = array_keys($post);
          $feedbacks->up($id, $keys_post, $post);
          $this->array_ajax['return'] = ['path' => $path];
        } else {
          $this->array_ajax['status'] = false;
          $this->array_ajax['return'] = ['error' => 'Arquivo inválido!'];  
        }
      } else {
        $keys_post = array_keys($post);
        $feedbacks->up($id, $keys_post, $post);
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

      $feedbacks = new Feedbacks();
      $feedback = $feedbacks->delete($id_decoded);

      $path_cover_old = parse_url($feedback['cover'], PHP_URL_PATH); // Extrair o caminho da URL
      $filename_with_dir = basename($path_cover_old); // Obter a parte final do caminho (nome do arquivo com diretório)
      $parent_dir = dirname($path_cover_old); // Obter o diretório pai do arquivo
      $last_two_parts = '/' . substr($parent_dir, strrpos($parent_dir, '/') + 1) . '/' . $filename_with_dir; // Obter as duas últimas partes

      if (file_exists('assets/images' . $last_two_parts)) {
        unlink('assets/images' . $last_two_parts);
      }
    }

    header('Location: ' . BASE . 'admin/feedbacks');
  }
}
