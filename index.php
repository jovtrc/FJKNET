<?php

session_start();

if(isset($_SESSION['FJK_id'])) { header("Location: sistema/index.php"); }

if(isset($_GET["login_first"])) {
	echo '
		<div class="alert alert-danger alert-fixed-bottom">
			Faça login para ter acesso ao sistema.
		</div>
	';
}

if(isset($_GET["session_ending_success"])) {
	echo '
		<div class="alert alert-success alert-fixed-bottom">
			Deslogado com sucesso!
		</div>
	';
}

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<title>Fazer login - FJKMED</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<link href="sistema/assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="sistema/assets/css/login.css" rel="stylesheet">
	</head>

	<body class="fazer-login">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-12 col-md-8 d-none d-md-block">
					<div class="p-5">
						<img src="sistema/assets/img/logo/logo-branco.png" class="logo img-fluid">
					</div>
				</div>

				<div class="col-12 col-md-4 area-login">
					<form method="POST" action="controller/login.php">
						<small>Usuário BETA: admin@email.com</small>
						<input type="email" name="email" class="form-control" placeholder="Usuário" value="">

						<small>Senha BETA: 123456</small>
						<input type="password" name="password" class="form-control" placeholder="Senha" value="">
						<button class="btn">Acessar sistema</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
