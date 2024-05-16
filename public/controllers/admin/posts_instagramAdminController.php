<?php

class posts_instagramAdminController extends controller {
  public function __construct()
  {
    if (empty($_SESSION['user_admin']) && empty($_COOKIE['user_admin'])) {
      header('Location: ' . BASE . 'admin/account/sign_in');
    }
  }
  
  public function index()
  {
    $this->loadTemplateAdmin('posts-instagram-list');
  }

  public function form($id = null)
  {
    $data = [];

    $posts_instagram = new PostsInstagram();

    if (!empty($id)) {
      $id_decoded = base64_decode($id);
      $post = $posts_instagram->get($id_decoded);
      
      $data['post'] = $post;
      $data['id'] = $id;
    }
    
    $this->loadTemplateAdmin('posts-instagram-form', $data);
  }

  public function list()
  {
    $posts_instagram = new PostsInstagram();
    $ajax_return = [];

    $all = $posts_instagram->getAll($_GET);
    $count = $posts_instagram->getCount($_GET['search']['value']);

    function filter($post_instagram) {
      return [
        '
          <img src="' . $post_instagram['cover'] . '" width="50" height="50" class="rounded" alt="" />
        ', 
        '
          <a href="' . $post_instagram['link'] . '" target="_blank">' . $post_instagram['link'] . '</a>
        ', 
        '
          <div class="dropdown">
            <button class="btn btn-outline-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ações
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="' . BASE . 'admin/posts_instagram/form/' . base64_encode($post_instagram['id']) . '">Editar</a></li>
              <li><a class="dropdown-item" href="' . BASE . 'admin/posts_instagram/delete/' . base64_encode($post_instagram['id']) . '">Deletar</a></li>
            </ul>
          </div>
        '
      ];
    }

    $ajax_return['draw'] = intval($_GET['draw']);
    $ajax_return['recordsTotal'] = $count['qtd_posts'];
    $ajax_return['recordsFiltered'] = $count['qtd_posts'];
    $ajax_return['data'] = array_map('filter', $all);

    echo json_encode($ajax_return);
  }

  public function add()
  {
    $posts_instagram = new PostsInstagram();

    if (
      !empty($_FILES['cover']) && 
      !empty($_POST['link'])
    ) {
      $cover = $_FILES['cover'];
      $link = addslashes($_POST['link']);

      if (!empty($cover['tmp_name'])) {
        $path = uploadFile($cover);
        $posts_instagram->set($path, $link);

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
    $posts_instagram = new PostsInstagram();

    if (
      !empty($_POST['ip']) && 
      ( 
        !empty($_FILES['cover']) || 
        !empty($_POST['link']) 
      )
    ) {
      $post = $_POST;
      array_shift($post);

      $id = addslashes(base64_decode($_POST['ip']));
      $post_instagram = $posts_instagram->get($id);

      if (!empty($_FILES['cover'])) {
        $cover = $_FILES['cover'];

        if (!empty($cover['tmp_name'])) {
          deleteFile($post_instagram['cover']);
          $path = uploadFile($cover);

          $post['cover'] = $path;
          $keys_post = array_keys($post);
          $posts_instagram->up($id, $keys_post, $post);
          $this->array_ajax['return'] = ['path' => $path];
        } else {
          $this->array_ajax['status'] = false;
          $this->array_ajax['return'] = ['error' => 'Arquivo inválido!'];  
        }
      } else {
        $keys_post = array_keys($post);
        $posts_instagram->up($id, $keys_post, $post);
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

      $posts_instagram = new PostsInstagram();
      $post_instagram = $posts_instagram->delete($id_decoded);
      deleteFile($post_instagram['cover']);
    }

    header('Location: ' . BASE . 'admin/posts_instagram');
  }
}
