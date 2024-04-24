<?php

class geotecniaController extends controller {
  public function index()
  {
    $this->loadTemplate('geotecnia', [
      "banner" => [
        "image" => "https://img.freepik.com/fotos-gratis/as-mulheres-agricultoras-estao-pesquisando-o-solo_1150-8171.jpg?t=st=1713966531~exp=1713970131~hmac=acfb69bf452cfa89c7958abf32e52eb46416d337cc8af3eba05da14550d8e024&w=1380",
        "subtitle" => "Geotecnia",
        "title" => "O que é a Geotecnia?",
        "text" => "Geotecnia é a aplicação de métodos científicos e princípios de engenharia para a aquisição, interpretação e uso do conhecimento dos materiais da crosta terrestre e materiais terrestres para a solução de problemas de engenharia.",
      ],
    ]);
  }
}
