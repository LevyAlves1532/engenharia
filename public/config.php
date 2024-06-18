<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$config = array();

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$conexao = "localhost";
preg_match("/{$conexao}/i", $url, $match);

//defininco se esta em desenvolvimento ou produção
if (!empty($match)) {
	define("BASE", "http://localhost/projetos/Daniel/civil_engineer_portfolio/public/");
	define('ACCESS_TOKEN_MERCADO_PAGO', 'TEST-422895419841354-053010-5c3259dbb8311a4eef64aca095dd9275-1685623783');
	$config["dbname"] = "civil_engineer_daniel";
	$config["host"] = "localhost";
	$config["dbuser"] = "root";
	$config["dbpass"] = "";
} else {
	define("BASE", "http://www.levy-projects.infinityfreeapp.com/engenharia_daniel/");
	define('ACCESS_TOKEN_MERCADO_PAGO', 'TEST-422895419841354-053010-5c3259dbb8311a4eef64aca095dd9275-1685623783');
	$config["dbname"] = "if0_36721860_civil_engineer_daniel";
	$config["host"] = "sql309.infinityfree.com";
	$config["dbuser"] = "if0_36721860";
	$config["dbpass"] = "EUcdUxMBOIbA";
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

$mail = new PHPMailer(true);

try {
	$mail->isSMTP();
	$mail->Host = 'localhost';
	$mail->SMTPAuth = false;
	$mail->SMTPAuthTLS = false;
	$mail->Port = 25;

	global $mail;
} catch(Exception $e) {
	echo "Error de email!";
	exit;
}
