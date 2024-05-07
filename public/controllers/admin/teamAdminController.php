<?php

class teamAdminController extends controller {
  public function index()
  {
    $this->loadTemplateAdmin('team-list');
  }

  public function form($id = null)
  {
    $this->loadTemplateAdmin('team-form');
  }
}
