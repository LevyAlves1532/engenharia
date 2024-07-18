<?php

class portfolioController extends controller {
  public function index()
  {
    $data = [];

    $posts_instagram = new PostsInstagram();
    $projects = new Projects();
    $feedbacks = new Feedbacks();

    $data['posts'] = $posts_instagram->getAllNoneFilters();
    $data['projects'] = $projects->getThree();
    $data['feedbacks'] = $feedbacks->getAllNoneFilters();

    $this->loadTemplate('portfolio', $data);
  }
}
