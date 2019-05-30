<?php

session_start();

include_once '../model/Conexao.class.php';
include_once '../model/Autenticacao.class.php';

$autenticacao = new Autenticacao;
$autenticacao->logout();

?>