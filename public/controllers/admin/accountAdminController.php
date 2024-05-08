<?php

class accountAdminController extends controller
{
  public function index()
  {
    $this->loadTemplateAdmin('my-profile');
  }

  public function sign_in()
  {
    $this->loadView('admin/sign-in');
  }
}
