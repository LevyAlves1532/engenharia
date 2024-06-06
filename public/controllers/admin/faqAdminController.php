<?php

class faqAdminController extends controller {
  public function index()
  {
    $this->loadTemplateAdmin('faq-list');
  }

  public function form($id = null)
  {
    $data = [];

    $faq = new Faq();

    if (!empty($id)) {
      $id_decoded = base64_decode($id);
      $faq_item = $faq->get($id_decoded);

      $data['faq'] = $faq_item;
      $data['id'] = $id;
    }

    $this->loadTemplateAdmin('faq-form', $data);
  }

  public function list()
  {
    $faq = new Faq();
    $ajax_return = [];

    $all = $faq->getAll($_GET);
    $count = $faq->getCount($_GET['search']['value']);

    function filter($faq_item) {
      return [
        $faq_item['question'], 
        '
          <div class="dropdown">
            <button class="btn btn-outline-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ações
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="' . BASE . 'admin/faq/form/' . base64_encode($faq_item['id']) . '">Editar</a></li>
              <li><a class="dropdown-item" href="' . BASE . 'admin/faq/delete/' . base64_encode($faq_item['id']) . '">Deletar</a></li>
            </ul>
          </div>
        '
      ];
    }

    $ajax_return['draw'] = intval($_GET['draw']);
    $ajax_return['recordsTotal'] = $count['qtd_faq'];
    $ajax_return['recordsFiltered'] = $count['qtd_faq'];
    $ajax_return['data'] = array_map('filter', $all);

    echo json_encode($ajax_return);
  }

  public function add()
  {
    $faq = new Faq();

    if (
      !empty($_POST['question']) && 
      !empty($_POST['response'])
    ) {
      $question = addslashes($_POST['question']);
      $response = addslashes($_POST['response']);

      $faq->set($question, $response);

      $this->array_ajax['status'] = true;
      $this->array_ajax['return'] = ['data' => 'Pergunta adicionada!'];
    } else {
      $this->array_ajax['status'] = false;
      $this->array_ajax['return'] = ['error' => 'Está faltando parâmetros!'];
    }
    
    echo json_encode($this->array_ajax);
  }

  public function edit()
  {
    $faq = new Faq();

    if (
      !empty($_POST['if']) && 
      ( 
        !empty($_POST['question']) || 
        !empty($_POST['response'])
      )
    ) {
      $post = $_POST;
      array_shift($post);

      $id = addslashes(base64_decode($_POST['if']));

      $keys_post = array_keys($post);
      $faq->up($id, $keys_post, $post);
      $this->array_ajax['status'] = true;
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

      $faq = new Faq();
      $faq->delete($id_decoded);
    }

    header('Location: ' . BASE . 'admin/faq');
  }
}
