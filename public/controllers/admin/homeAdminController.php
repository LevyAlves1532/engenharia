<?php

class homeAdminController extends controller
{
  public function __construct()
  {
    if (empty($_SESSION['user_admin']) && empty($_COOKIE['user_admin'])) {
      header('Location: ' . BASE . 'admin/account/sign_in');
    }
  }

  public function index()
  {
    $data = [];

    $projects = new Projects();
    $team = new Team();
    $feedbacks = new Feedbacks();
    $posts_instagram = new PostsInstagram();

    $data['qtd_projects'] = $projects->getCount('')['qtd_projects'];
    $data['qtd_person_team'] = $team->getCount('')['qtd_team'];
    $data['qtd_feedbacks'] = $feedbacks->getCount('')['qtd_feedbacks'];
    $data['qtd_posts'] = $posts_instagram->getCount('')['qtd_posts'];

    $this->loadTemplateAdmin('home', $data);
  }

  public function values()
  {
    $ajax_return = [];

    $payments = new Payments();

    $months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
    $ajax_return['months'] = $months;

    $profits = [];

    foreach ($months as $key => $month) {
      $profit_month = $payments->getProfitMonth($key + 1)['profit_month'];
      array_push($profits, $profit_month === null ? 0 : floatval(number_format($profit_month, 2)));
    }

    $ajax_return['profits'] = $profits;

    echo json_encode($ajax_return);
  }
}
