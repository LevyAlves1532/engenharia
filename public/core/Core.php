<?php

class Core
{

  public function run()
  {

    $url = "/";
    $admin = false;
    if (isset($_GET["url"])) {
      $url .= $_GET["url"];
    }

    $params = array();

    if (!empty($url) && ($url == "/admin" || $url == "/admin/")) {
      $currentController = "homeAdminController";
      $currentAction = "index";
      $admin = true;
    } else if (!empty($url) && $url != "/") {
      $url = explode("/", $url);
      //ARRAY_SHIFT REVOME O PRIMEIRO REGISTRO DO ARRAY
      array_shift($url);

      if ($url[0] === "admin") {
        array_shift($url);
        $admin = true;
      }

      $currentController = !$admin ? $url[0] . "Controller" : $url[0] . "AdminController";
      array_shift($url);

      if (isset($url[0]) && !empty($url[0])) {
        $currentAction = $url[0];
        array_shift($url);
      } else {
        $currentAction = "index";
      }

      if (count($url) > 0) {
        $params = $url;
      };
    } else {
      $currentController = "homeController";
      $currentAction = "index";
    }

    if (!file_exists(!$admin ? "controllers/" . $currentController . ".php" : "controllers/admin/" . $currentController . ".php") || !method_exists($currentController, $currentAction)) {
      $currentController = "notfoundController";
      $currentAction = "index";
    }

    $c = new $currentController();
    call_user_func_array(array($c, $currentAction), $params);
  }
}
