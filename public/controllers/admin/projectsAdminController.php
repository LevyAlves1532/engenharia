<?php

class projectsAdminController extends controller {
  public function index()
  {
    $this->loadTemplateAdmin('projects-list');
  }

  public function form($id = null)
  {
    $data = [];

    if (isset($id) && !empty($id)) {
      $data['project'] = [
        'cover' => BASE . 'assets/images/daniel.jpg',
        'carousel' => [
          ['image' => BASE . 'assets/images/daniel.jpg'],
          ['image' => BASE . 'assets/images/daniel.jpg'],
          ['image' => BASE . 'assets/images/daniel.jpg']
        ],
        'title' => 'General Construction',
        'price' => 124.00,
        'is_discount' => true,
        'discount' => 10,
        'short_description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, neque id.',
        'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea nobis inventore error illum dolore fuga deserunt aliquid doloremque voluptatibus earum placeat quis necessitatibus officiis dolorem consectetur velit sit, reiciendis expedita animi amet. Nisi animi consectetur assumenda veniam incidunt voluptate accusamus deleniti, amet pariatur laudantium facere sequi, nesciunt nemo sed omnis sint? Cumque facilis, mollitia numquam aspernatur vel id esse ab. Lorem ipsum dolor sit amet consectetur adipisicing elit. Est cupiditate necessitatibus, animi dolorem qui assumenda provident. Accusantium sunt nobis saepe?',
        'square_meters' => 100,
        'bathrooms' => 2,
        'bedrooms' => 2,
        'garages' => 2,
        'files_projects' => [
          ['file' => BASE . 'assets/images/daniel.zip'],
          ['file' => BASE . 'assets/images/daniel.jpg'],
          ['file' => BASE . 'assets/images/daniel.png'],
        ],
      ];
    }

    $this->loadTemplateAdmin('projects-form', $data);
  }
}
