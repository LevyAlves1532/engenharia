<?php

class contaController extends controller {
  public function index()
  {
    if (!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])) {
      $this->loadTemplate('account-form');
    }
  }
}
