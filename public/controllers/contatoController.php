<?php

class contatoController extends controller {
  public function index()
  {
    $data = [];

    $faq = new Faq();

    $data['faq'] = $faq->getAllNoneFilters();

    $this->loadTemplate('contact', $data);
  }
}
