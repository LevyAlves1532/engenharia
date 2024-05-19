<?php

class sobreController extends controller {
  public function index()
  {
    $data = [];

    $team = new Team();

    $data['team'] = $team->getAllNoneFilters();

    $this->loadTemplate("about", $data);
  }
}
