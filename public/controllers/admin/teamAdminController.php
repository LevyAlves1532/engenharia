<?php

class teamAdminController extends controller {
  public function index()
  {
    $this->loadTemplateAdmin('team-list');
  }
}
