<?php

class geotecniaController extends controller {
  public function index()
  {
    $this->loadTemplate('geotecnia', [
      "banner" => [
        "image" => BASE . 'assets/images/banner_geotecnia.webp',
        "subtitle" => "Geotecnia",
        "title" => "O que é a Geotecnia?",
        "text" => "Geotecnia é a aplicação de métodos científicos e princípios de engenharia para a aquisição, interpretação e uso do conhecimento dos materiais da crosta terrestre e materiais terrestres para a solução de problemas de engenharia.",
      ],
    ]);
  }
}
