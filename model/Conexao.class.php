<?php

// Classe que faz conexão com banco e configura horários
class Conexao {
	public static $instance;

	//Aqui faz a conexão com o banco de dados
	public static function get_instance() {
		if(!isset(self::$instance)) {
			self::$instance = new PDO("mysql:host=localhost;dbname=kurama_fjkmed;", "kurama_fjkmed", "e1294520@@", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		return self::$instance;
	}
}

// Aqui define o horário do sistema
date_default_timezone_set('America/Sao_Paulo');
$dataHoje = date("d/m/Y H:i");

?>
