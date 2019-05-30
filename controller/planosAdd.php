<?php

include_once '../model/Conexao.class.php';
include_once '../model/Crud.class.php';

$crud = new Crud();

$dados = $_POST;

if(isset($dados) && !empty($dados)) {
	$crud->incluir("tb_cliente_planos", $dados);
	header("Location: ../sistema/planos.php?cadastrado_sucesso");
}

?>
