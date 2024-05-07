<?php

class teamAdminController extends controller {
  public function index()
  {
    $this->loadTemplateAdmin('team-list');
  }

  public function form($id = null)
  {
    $data = [];

    if (!empty($id)) {
      $data['team'] = [
        'photo' => BASE . 'assets/images/daniel.jpg',
        'name' => 'Daniel Alves',
        'profession' => 'Civil Engineer'
      ];
    }

    $this->loadTemplateAdmin('team-form', $data);
  }
}
