<?php

include_once '../model/Conexao.class.php';
include_once '../model/Crud.class.php';

$crud = new Crud();

$campo = $_POST;

if(isset($campo) && !empty($campo)) {
	$crud->deletar("tb_financeiro_lancamentos", $campo);
	header("Location: ../sistema/lancamentos.php?deletado_sucesso");
}
