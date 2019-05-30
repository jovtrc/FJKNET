<?php

include_once '../model/Conexao.class.php';
include_once '../model/Crud.class.php';

$crud = new Crud();

$campo = $_POST;

if(isset($campo) && !empty($campo)) {
	$crud->deletar("tb_profissionais", $campo);

	header("Location: ../sistema/usuarios.php?deletado_sucesso");
}

?>
