<?php

class controller
{
	protected $mail;
	protected $array_ajax;

	public function __construct() {
		global $mail;

		$this->array_ajax = ["status" => true, "return" => []];
		$this->mail = $mail;
	}

	public function loadView($viewName, $viewData = array())
	{
		//ESSA FUNÇÃO CONVERTE A CHAVE DE UMA ARRAY EM UMA VARIAVEL
		extract($viewData);
		//LINKA O ARQUIVO DA PASTA VIEWS
		//A VARIAVEL $viewName foi definida no homeController.php
		require 'views/' . $viewName . '.php';
	}
	//carregando template
	public function loadTemplate($viewName, $viewData = array())
	{
		require 'views/template.php';
	}

	public function loadViewInTemplate($viewName, $viewData = array())
	{
		extract($viewData);
		require 'views/' . $viewName . '.php';
	}
	
	public function loadTemplateAdmin($viewName, $viewData = array())
	{
		require 'views/admin/template.php';
	}

	public function loadViewInTemplateAdmin($viewName, $viewData = array())
	{
		extract($viewData);
		require 'views/admin/' . $viewName . '.php';
	}
}
