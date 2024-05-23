<?php

class projetosController extends controller {
  public function index() {
    $this->loadTemplate('projects');
  }

  public function produto($slug)
  {
    $this->loadTemplate('product');;
  }

  public function list()
  {
    $projects = new Projects();
    $ajax_return = [];
    $filters = [];

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

    echo json_encode($ajax_return);
  }
}
