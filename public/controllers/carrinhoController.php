<?php

class carrinhoController extends controller {
  public function index()
  {
    $this->loadTemplate('cart');
  }

  public function comprar()
  {
    $ajax_return = [];

    if (!empty($_SESSION['user'])) {
      $ajax_return['data'] = 'Sucesso!';
    } else {
      $ajax_return['error'] = 'Não está logado!';
    }

    echo json_encode($ajax_return);
  }
}
