<?php

class paymentsAdminController extends controller {
  public function __construct()
  {
    if (empty($_SESSION['user_admin']) && empty($_COOKIE['user_admin'])) {
      header('Location: ' . BASE . 'admin/account/sign_in');
    }
  }

  public function index()
  {
    $this->loadTemplateAdmin('payments-list');
  }

  public function view($id)
  {
    if (!empty($id)) {
      $this->loadTemplateAdmin('payments-view');
    } else {
      header('Location ' . BASE . 'admin/payments');
    }
  }
}
