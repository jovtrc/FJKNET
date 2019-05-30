<?php

include_once '../model/Conexao.class.php';
include_once '../model/Crud.class.php';

$crud = new Crud();

$dados_edit = $_POST;
$id = $_POST["id"];

if(isset($dados_edit) && !empty($dados_edit)) {
	$crud->editar("tb_profissionais", $dados_edit, $id);
	header("Location: ../sistema/usuarios.php?editado_sucesso");
}

?>
