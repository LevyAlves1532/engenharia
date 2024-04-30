<?php

class carrinhoController extends controller {
  public function index()
  {
    $this->loadTemplate('cart');
  }
}
