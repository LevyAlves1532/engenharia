<?php

class projetosController extends controller {
  public function index() {
    $this->loadTemplate('projects');
  }

  public function produto($slug)
  {
    $this->loadTemplate('product');;
  }
}
