<?php

// Aqui verifica se o usuário logou no sistema, se não, redireciona pra index, e também verifica os parâmetros GET enviados

session_start();

if(isset($_SESSION['FJK_id'])) { }
else { header("Location: ../index.php?login_first"); }

if(isset($_GET["login_success"])) {
	echo '
		<div class="alert alert-success alert-fixed-bottom">
			Login realizado com sucesso!
		</div>
	';
} else if(isset($_GET["cadastrado_sucesso"])) {
	echo '
		<div class="alert alert-success alert-fixed-bottom">
			Salvo com sucesso!
		</div>
	';
} else if(isset($_GET["deletado_sucesso"])) {
	echo '
		<div class="alert alert-success alert-fixed-bottom">
			Registro removido com sucesso!
		</div>
	';
} else if(isset($_GET["editado_sucesso"])) {
	echo '
		<div class="alert alert-success alert-fixed-bottom">
			Editado com sucesso!
		</div>
	';
} else if(isset($_GET["finalizado_sucesso"])) {
	echo '
		<div class="alert alert-success alert-fixed-bottom">
			Consulta finalizada com sucesso!
		</div>
	';
}
?>