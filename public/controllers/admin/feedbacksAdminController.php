<?php

class feedbacksAdminController extends controller {
  public function __construct()
  {
    if (empty($_SESSION['user_admin']) && empty($_COOKIE['user_admin'])) {
      header('Location: ' . BASE . 'admin/account/sign_in');
    }
  }

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
        number_format($feedback['assessment'], 1, ',', '.'), 
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
      $assessment = str_replace(',', '.', addslashes($_POST['assessment']));
      $short_description = addslashes($_POST['short_description']);

      if (!empty($cover['tmp_name'])) {
        $path = uploadFile($cover);
        $feedbacks->set($path, $name, $assessment, $short_description);

        $this->array_ajax['status'] = true;
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

      if (!empty($_POST['assessment'])) {
        $post['assessment'] = str_replace(',', '.', $_POST['assessment']);
      }

      if (!empty($_FILES['cover'])) {
        $cover = $_FILES['cover'];

        if (!empty($cover['tmp_name'])) {
          deleteFile($feedback['cover']);  
          $path = uploadFile($cover);

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

      $feedbacks = new Feedbacks();
      $feedback = $feedbacks->delete($id_decoded);
      deleteFile($feedback['cover']);
    }

    header('Location: ' . BASE . 'admin/feedbacks');
  }
}
