<?php

include_once '../model/Conexao.class.php';
include_once '../model/Crud.class.php';

$crud = new Crud();

$dados = $_POST;

if(isset($dados) && !empty($dados)) {
	$crud->incluir("tb_estoque_produto_categoria", $dados);
	header("Location: ../sistema/produtosCategorias.php?cadastrado_sucesso");
}
