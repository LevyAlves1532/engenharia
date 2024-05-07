<?php

class posts_instagramAdminController extends controller {
  public function index()
  {
    $this->loadTemplateAdmin('posts-instagram-list');
  }

  public function form($id = null)
  {
    $data = [];

    if (!empty($id)) {
      $data['post'] = [
        'cover' => BASE . 'assets/images/daniel.jpg',
        'link' => 'https://www.instagram.com/p/CNoLw8sFvNZ/',
      ];
    }
    
    $this->loadTemplateAdmin('posts-instagram-form', $data);
  }
}
