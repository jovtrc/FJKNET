<?php

session_start();

include_once '../model/Conexao.class.php';
include_once '../model/Autenticacao.class.php';

$autenticacao = new Autenticacao;

$email = addslashes($_POST['email']);
$password = $_POST['password'];

if(isset($_POST['email']) && !empty($_POST['email'])) {
	$autenticacao->login($email, $password);
}
?>