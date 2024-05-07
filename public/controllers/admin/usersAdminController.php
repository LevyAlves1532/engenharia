<?php

class usersAdminController extends controller {
  public function index()
  {
    $this->loadTemplateAdmin('users-list');
  }

  public function form($id = null)
  {
    $data = [];

    if (!empty($id)) {
      $data['user'] = [
        'name' => 'Daniel Alves',
        'email' => 'danielmartins@gmail.com',
      ];
    }

    $this->loadTemplateAdmin('users-form', $data);
  }
}
