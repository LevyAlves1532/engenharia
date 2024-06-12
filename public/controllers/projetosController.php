<?php

class projetosController extends controller {
  public function index() {
    $this->loadTemplate('projects');
  }

  public function produto($slug)
  {
    $data = [];

    $payment_projects = new PaymentProjects();

    if (!empty($slug)) {
      $projects = new Projects();

      $project = $projects->getSlug(addslashes($slug));

      if ($project === []) header('Location: ' . BASE . 'projetos');

      $data['project'] = $project;
      $data['slug'] = $slug;
      
      if (!empty($_SESSION['user'])) {
        $buy_project = $payment_projects->is_buy($_SESSION['user']['id'], $project['id']);
        
        if ($buy_project) {
          $data['buy_project'] = true;
        }
      }
    }

    $this->loadTemplate('product', $data);
  }

  public function list()
  {
    $projects = new Projects();
    $payment_projects = new PaymentProjects();

    $ajax_return = [];
    $filters = ['is_active = 1'];

    $current_page = intval(addslashes($_GET['current_page']));

    if (!empty($_GET['search'])) {
      $search = addslashes($_GET['search']);
      array_push($filters, 'title LIKE "%' . $search . '%"');
    }

    if (!empty($_GET['square_meters'])) {
      $square_meters = floatval(str_replace(',', '.', addslashes($_GET['square_meters'])));
      array_push($filters, 'square_meters >= ' . $square_meters);
    }

    if (!empty($_GET['bathrooms'])) {
      $bathrooms = intval(str_replace(',', '.', addslashes($_GET['bathrooms'])));
      array_push($filters, 'bathrooms = ' . $bathrooms);
    }

    if (!empty($_GET['bedrooms'])) {
      $bedrooms = intval(str_replace(',', '.', addslashes($_GET['bedrooms'])));
      array_push($filters, 'bedrooms = ' . $bedrooms);
    }

    if (!empty($_GET['garages'])) {
      $garages = intval(str_replace(',', '.', addslashes($_GET['garages'])));
      array_push($filters, 'garages = ' . $garages);
    }

    if (!empty($_GET['min'])) {
      $min =  floatval(str_replace(',', '.', addslashes($_GET['min'])));
      array_push($filters, 'price >= ' . $min);
    }
 
    if (!empty($_GET['max'])) {
      $max = floatval(str_replace(',', '.', addslashes($_GET['max'])));
      array_push($filters, 'price < ' . $max);
    }

    $qtd_projects = $projects->getCountFilters($filters);
    $limit = 5;

    $qtd_pages = ceil($qtd_projects / $limit);
    $from_project = ($current_page - 1) * $limit;

    if ($current_page <= $qtd_pages) {
      $ajax_return['data'] = $projects->getAllFilters($filters, $from_project, $limit);
      $ajax_return['qtd_projects'] = $qtd_projects;
      $ajax_return['qtd_pages'] = $qtd_pages;
      $ajax_return['current_page'] = $current_page;
    } else {
      $ajax_return['error'] = 'Projetos não encontrados!';
    }

    foreach ($ajax_return['data'] as $key => $project) {
			if (!empty($_SESSION['user'])) {
				$ajax_return['data'][$key]['is_buy'] = $payment_projects->is_buy($_SESSION['user']['id'], $project['id']) ? 1 : 0;
				$ajax_return['data'][$key]['is_logged'] = 1;
			} else {
				$ajax_return['data'][$key]['is_buy'] = 0;
				$ajax_return['data'][$key]['is_logged'] = 0;
			}
		}

    echo json_encode($ajax_return);
  }

  public function project()
  {
    $projects = new Projects();
    $payment_projects = new PaymentProjects();

    $ajax_return = [];

    if (!empty($_GET['slug'])) {
      $slug = addslashes($_GET['slug']);

      $project = $projects->getSlug($slug);

      $ajax_return['data'] = $project;
      $ajax_return['data']['is_buy'] = (!empty($_SESSION['user']) && $payment_projects->is_buy($_SESSION['user']['id'], $project['id'])) ? 1 : 0;
      $ajax_return['data']['is_logged'] = !empty($_SESSION['user']) ? 1 : 0;
    } else {
      $ajax_return['error'] = 'Projeto não encontrado!';
    }

    echo json_encode($ajax_return);
  }

  public function baixar_arquivos($slug = null)
  {
    $payment_projects = new PaymentProjects();
    $projects = new Projects();
    $project_files = new ProjectFiles();

    if (!empty($slug)) {
      $project = $projects->getSlug($slug);
      $is_buy = $payment_projects->is_buy($_SESSION['user']['id'], $project['id']);

      if ($project !== [] && $is_buy) {
        $payment_projects->mark_download($_SESSION['user']['id'], $project['id']);
        $files = $project_files->getAllFromIdProject($project['id']);

        $zip = new ZipArchive();
        $zipName = $project['slug'] . '.zip';

        if ($zip->open($zipName, ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file) {
                $fileContent = file_get_contents($file['file']);
                $fileName = basename($file['file']);
                $zip->addFromString($fileName, $fileContent);
            }
            $zip->close();
        }

        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$zipName);
        header('Content-Length: ' . filesize($zipName));
        readfile($zipName);

        // Excluir o arquivo zip após o download
        unlink($zipName);
      }

      echo 'ok';
      header('Location: ' . BASE . 'projetos/produto' . $slug);
    } else {
      header('Location: ' . BASE . 'projetos');
    }
  }
}
