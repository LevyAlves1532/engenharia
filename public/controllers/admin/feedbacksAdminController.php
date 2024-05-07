<?php

class feedbacksAdminController extends controller {
  public function index()
  {
    $this->loadTemplateAdmin('feedbacks-list');
  }

  public function form($id = null)
  {
    $data = [];

    if (!empty($id)) {
      $data['feedback'] = [
        'cover' => BASE . 'assets/images/daniel.jpg',
        'name' => 'Enrico Antonio Peixoto',
        'assessment' => 5,
        'short_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora vero vitae, similique nisi saepe veritatis architecto optio amet, possimus dolor magni laborum vel illo molestiae nam non. Corrupti, laboriosam eveniet.',
      ];
    }

    $this->loadTemplateAdmin('feedbacks-form', $data);
  }
}
