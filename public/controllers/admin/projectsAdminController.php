<?php

class projectsAdminController extends controller {
  private $permissions_user_projects = [];

  public function __construct()
  {
    if (!empty($_SESSION['user_admin']) && empty($_COOKIE['user_admin'])) {
      $user_admin = $_SESSION['user_admin'];
      $permissions = json_decode($user_admin['permissions']);

      if (!property_exists($permissions, 'projects')) {
        unset($_SESSION['user_admin']);
        header('Location: ' . BASE . 'admin/account/sign_in');
      }

      $this->permissions_user_projects = $permissions->projects;
    } else {
      header('Location: ' . BASE . 'admin/account/sign_in');
    }
  }

  public function index()
  {
    if (!in_array('READ', $this->permissions_user_projects)) {
      header('Location: ' . BASE . 'admin/');
      exit;
    }

    $this->loadTemplateAdmin('projects-list');
  }

  public function form($id = null)
  {
    if (empty($id) && !in_array('INSERT', $this->permissions_user_projects)) {
      header('Location: ' . BASE . 'admin/projects');
      exit;
    } else if (!empty($id) && !in_array('UPDATE', $this->permissions_user_projects)) {
      header('Location: ' . BASE . 'admin/projects');
      exit;
    }

    $data = [];

    $projects = new Projects();
    $project_carousel = new ProjectCarousel();
    $project_files = new ProjectFiles();

    if (!empty($id)) {
      $id_decoded = base64_decode($id);
      $project = $projects->get($id_decoded);
      $carousel = $project_carousel->getAllFromIdProject($id_decoded);
      $files = $project_files->getAllFromIdProject($id_decoded);

      $data['project'] = $project;
      $data['project']['carousel'] = $carousel;
      $data['project']['files_projects'] = $files;
      $data['id'] = $id;
    }

    $this->loadTemplateAdmin('projects-form', $data);
  }

  public function list()
  {
    $projects = new Projects();
    $ajax_return = [];

    $all = $projects->getAll($_GET);
    $count = $projects->getCount($_GET['search']['value']);

    function filter($project) {
      $projects = new Projects();
      
      return [
        '
          <img src="' . $project['cover'] . '" width="50" height="50" class="rounded" alt="" />
        ', 
        $project['title'], 
        $project['is_discount'] == 1 ? '<strike>' . number_format($project['price'], 2, ",", ".") . '</strike> - ' . number_format(floatval(str_replace(',', '.', $project['price'])) - floatval(str_replace(',', '.', $project['price'])) * intval(str_replace(',', '.', $project['discount_percent'])) / 100, 2, ",", ".") : number_format($project['price'], 2, ",", "."),
        $projects->getIsActive($project['is_active']),
        '
          <div class="dropdown">
            <button class="btn btn-outline-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ações
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="' . BASE . 'admin/projects/form/' . base64_encode($project['id']) . '">Editar</a></li>
              <li><a class="dropdown-item" href="' . BASE . 'admin/projects/toggle/' . base64_encode($project['id']) . '">' . ($project['is_active'] === 1 ? 'Desativar' : 'Ativar') . '</a></li>
            </ul>
          </div>
        '
      ];
    }

    $ajax_return['draw'] = intval($_GET['draw']);
    $ajax_return['recordsTotal'] = $count['qtd_projects'];
    $ajax_return['recordsFiltered'] = $count['qtd_projects'];
    $ajax_return['data'] = array_map('filter', $all);

    echo json_encode($ajax_return);
  }

  public function add()
  {
    $projects = new Projects();
    $project_carousel = new ProjectCarousel();
    $project_files = new ProjectFiles();

    if (
      !empty($_FILES['cover']) && 
      !empty($_FILES['carousel']) && 
      !empty($_POST['title']) &&
      !empty($_POST['slug']) &&
      isset($_POST['price']) &&
      isset($_POST['discount_percent']) &&
      !empty($_POST['short_description']) &&
      !empty($_POST['description']) &&
      !empty($_POST['square_meters']) &&
      !empty($_POST['bathrooms']) &&
      !empty($_POST['bedrooms']) &&
      !empty($_POST['garages']) &&
      !empty($_FILES['files_projects'])
    ) {
      $cover = $_FILES['cover'];
      $carousel = $_FILES['carousel'];
      $title = addslashes($_POST['title']);
      $slug = addslashes($_POST['slug']);
      $price = str_replace(',', '.', addslashes($_POST['price']));
      $discount_percent = addslashes($_POST['discount_percent']);
      $short_description = addslashes($_POST['short_description']);
      $description = addslashes($_POST['description']);
      $square_meters = str_replace(',', '.', addslashes($_POST['square_meters']));
      $bathrooms = addslashes($_POST['bathrooms']);
      $bedrooms = addslashes($_POST['bedrooms']);
      $garages = addslashes($_POST['garages']);
      $files_projects = $_FILES['files_projects'];
      $is_discount = null;

      if (!empty($_POST['is_discount'])) {
        $is_discount = addslashes($_POST['is_discount']);
      }

      if (!$projects->is_title($title)) {
        $cover_path = uploadFile($cover);
        $carousel_path = uploadMutipleFiles($carousel);
        $files_projects = uploadMutipleFiles($files_projects);

        if (!empty($cover_path) && count($carousel_path) > 0 && count($files_projects) > 0) {
          $project_id = $projects->set($cover_path, $title, $slug, $price, $discount_percent, $short_description, $description, $square_meters, $bathrooms, $bedrooms, $garages, $is_discount);

          foreach($carousel_path as $path_image) {
            $project_carousel->set($project_id, $path_image);
          }

          foreach($files_projects as $path_file) {
            $project_files->set($project_id, $path_file);
          }

          $this->array_ajax['status'] = true;
          $this->array_ajax['return'] = ['data' => 'Projeto criado com sucesso!'];
        } else {
          $this->array_ajax['status'] = false;
          $this->array_ajax['return'] = ['error' => 'Erro no upload dos arquivos!'];
        }
      } else {
        $this->array_ajax['status'] = false;
        $this->array_ajax['return'] = ['error' => 'Já ha um projeto com esse título!'];
      }
    } else {
      $this->array_ajax['status'] = false;
      $this->array_ajax['return'] = ['error' => 'Está faltando parâmetros!'];
    }
    echo json_encode($this->array_ajax);
  }

  public function delete_carousel($id = null)
  {
    if (!in_array('DELETE', $this->permissions_user_projects)) {
      header('Location: ' . BASE . 'admin/projects');
      exit;
    }

    $project_carousel = new ProjectCarousel();

    if (!empty($id) && !empty($_GET['ip'])) {
      $id_decoded = base64_decode($id);
      $id_project = addslashes(base64_decode($_GET['ip']));

      $project_carousel_item = $project_carousel->get($id_decoded, $id_project);

      deleteFile($project_carousel_item['image']);
      $project_carousel->delete($id_decoded, $id_project);

      header('Location: ' . BASE . 'admin/projects/form/' . $_GET['ip']);
    } else {
      header('Location: ' . BASE . 'admin/projects');
    }
  }

  public function delete_file($id = null)
  {
    if (!in_array('DELETE', $this->permissions_user_projects)) {
      header('Location: ' . BASE . 'admin/projects');
      exit;
    }

    $project_files = new ProjectFiles();

    if (!empty($id) && !empty($_GET['ip'])) {
      $id_decoded = base64_decode($id);
      $id_project = addslashes(base64_decode($_GET['ip']));

      $project_file = $project_files->get($id_decoded, $id_project);

      deleteFile($project_file['file']);
      $project_files->delete($id_decoded, $id_project);

      header('Location: ' . BASE . 'admin/projects/form/' . $_GET['ip']);
    } else {
      header('Location: ' . BASE . 'admin/projects');
    }
  }

  public function edit()
  {
    $projects = new Projects();
    $project_carousel = new ProjectCarousel();
    $project_files = new ProjectFiles();

    if (
      !empty($_POST['ip']) && 
      ( 
        !empty($_FILES['cover']) || 
        !empty($_FILES['carousel']) || 
        !empty($_POST['title']) ||
        !empty($_POST['slug']) ||
        !empty($_POST['price']) ||
        !empty($_POST['discount_percent']) ||
        !empty($_POST['short_description']) ||
        !empty($_POST['description']) ||
        !empty($_POST['square_meters']) ||
        !empty($_POST['bathrooms']) ||
        !empty($_POST['bedrooms']) ||
        !empty($_POST['garages']) ||
        !empty($_FILES['files_projects'])
      )
    ) {
      $post = $_POST;
      array_shift($post);

      $id = addslashes(base64_decode($_POST['ip']));
      $project = $projects->get($id);

      if (!empty($_FILES['cover'])) {
        $post['cover'] = uploadFile($_FILES['cover']);
      }

      if (!empty($_POST['is_discount'])) {
        $post['is_discount'] = 1;
      } else {
        $post['is_discount'] = 0;
      }

      if (!empty($_POST['price'])) {
        $post['price'] = str_replace(',', '.', $_POST['price']);
      }

      if (!empty($_POST['square_meters'])) {
        $post['square_meters'] = str_replace(',', '.', $_POST['square_meters']);
      }
      
      if (!empty($_POST['title']) && $project['title'] !== $_POST['title'] && !$projects->is_title($_POST['title'])) {
        $keys_post = array_keys($post);
        $projects->up($id, $keys_post, $post);
      } else {
        unset($post['title']);
        $keys_post = array_keys($post);
        $projects->up($id, $keys_post, $post);
      }

      if (!empty($_FILES['carousel'])) {
        $carousel_path = uploadMutipleFiles($_FILES['carousel']);

        $post['carousel'] = [];

        if (count($carousel_path) > 0) {
          foreach($carousel_path as $path_image) {
            array_push($post['carousel'], [
              'id' => base64_encode($project_carousel->set($id, $path_image)),
              'file' => $path_image,
            ]);
          }
        }
      }

      if (!empty($_FILES['files_projects'])) {
        $files_projects = uploadMutipleFiles($_FILES['files_projects']);

        $post['files'] = [];

        if (count($files_projects) > 0) {
          foreach($files_projects as $path_file) {
            array_push($post['files'], [
              'id' => base64_encode($project_files->set($id, $path_file)),
              'file' => $path_file,
            ]);
          }
        }
      }

      $post['id'] = $_POST['ip'];
      $this->array_ajax['status'] = true;
      $this->array_ajax['return'] = ['project' => $post];
    } else {
      $this->array_ajax['status'] = false;
      $this->array_ajax['return'] = ['error' => 'Está faltando parâmetros!'];
    }

    echo json_encode($this->array_ajax);
  }

  public function toggle($id)
  {
    if (!in_array('DELETE', $this->permissions_user_projects)) {
      header('Location: ' . BASE . 'admin/projects');
      exit;
    }

    if (!empty($id)) {
      $id_decoded = base64_decode($id);

      $projects = new Projects();
      $projects->toggle($id_decoded);
    }

    header('Location: ' . BASE . 'admin/projects');
  }
}
