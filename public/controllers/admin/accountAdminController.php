<?php

class accountAdminController extends controller
{
  public function index()
  {
  }

  public function sign_in()
  {
    $this->loadView('admin/sign-in');
  }
}
