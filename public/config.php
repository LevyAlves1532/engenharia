<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = array();

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$conexao = "localhost";
preg_match("/{$conexao}/i", $url, $match);

//defininco se esta em desenvolvimento ou produção
if (!empty($match)) {
	define("BASE", $_ENV['HOMOLOG_BASE_URL']);
	define('ACCESS_TOKEN_MERCADO_PAGO', $_ENV['HOMOLOG_ACCESS_TOKEN_MERCADO_PAGO']);
	$config["dbname"] = $_ENV['HOMOLOG_DBNAME'];
	$config["host"] = $_ENV['HOMOLOG_HOST'];
	$config["dbuser"] = $_ENV['HOMOLOG_DBUSER'];
	$config["dbpass"] = $_ENV['HOMOLOG_DBPASS'];
} else {
	define("BASE", $_ENV['BASE_URL']);
	define('ACCESS_TOKEN_MERCADO_PAGO', $_ENV['ACCESS_TOKEN_MERCADO_PAGO']);
	$config["dbname"] = $_ENV['DBNAME'];
	$config["host"] = $_ENV['HOST'];
	$config["dbuser"] = $_ENV['DBUSER'];
	$config["dbpass"] = $_ENV['DBPASS'];
}

global $db;

try {
	$options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"];
	$db = new PDO("mysql:dbname=" . $config["dbname"] . ";host=" . $config["host"], $config["dbuser"], $config["dbpass"], $options);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Falhou " . $e->getMessage();
	exit;
}
