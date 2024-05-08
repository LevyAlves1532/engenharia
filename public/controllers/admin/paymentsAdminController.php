<?php

class paymentsAdminController extends controller {
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
