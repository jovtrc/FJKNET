<?php
require '../controller/verLogado.php';

include_once '../model/Conexao.class.php';
include_once '../model/Crud.class.php';
include_once '../model/Usuario.class.php';

$crud = new Crud();
$usuario = new Usuario();

$id = $_GET['id'];

?>

<!DOCTYPE html>

<html lang="pt-br">

	<?php include_once 'estatico/head.php'; ?>

	<body class="painel">
		<?php include_once 'estatico/menu.php'; ?>

		<div class="conteudo">
			<?php include_once 'estatico/breadcrumbs.php'; ?>


			<!-- AREA CADASTRAR -->
			<div class="container-fluid">
				<div class="cadastrar py-3">
					<div class="card shadow">
						<div class="card-header">
							<h3 class="mb-0">
								Editar Usuário
								<a href="usuarios.php" class="btn btn-danger btn-sm float-right">Cancelar</a>
							</h3>
						</div>

						<div class="card-body">
							<form method="POST" action="../controller/usuariosEdit.php">
								<?php foreach($usuario->listarUmUsuario($id) as $pro): ?>

								<div class="row">
									<div class="col-12 col-md-4">
										<label for="nm_profissional">Nome</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
											<input required type="text" class="form-control" id="nm_profissional" name="nm_profissional" placeholder="Nome" value="<?=$pro['nm_profissional']?>">
										</div>
									</div>

									<div class="col-6 col-md-4">
										<label for="id_profissional_tipo">Tipo/Cargo</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-pencil"></i></span></div>
											<select required class="form-control" id="id_profissional_tipo" name="id_profissional_tipo">
												<option value="<?=$pro['id_profissional_tipo']?>"><?=$pro['ds_profissional_tipo']?></option>
												<option value="">---</option>
												<?php foreach($crud->listarTudo("tb_profissional_tipo") as $result): ?>
													<option value="<?php echo $result['id']; ?>"><?php echo $result['ds_profissional_tipo']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<div class="col-12 col-md-4">
										<label for="sal_profissional">Salário</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-usd"></i></span></div>
											<input required type="number" class="form-control" id="sal_profissional" name="sal_profissional" placeholder="Salário" value="<?=$pro['sal_profissional']?>" step="0.01">
										</div>
									</div>

									<div class="col-6">
										<label for="end_profissional">Endereço</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-home"></i></span></div>
											<input required type="text" class="form-control" id="end_profissional" name="end_profissional" placeholder="Endereço" value="<?=$pro['end_profissional']?>">
										</div>
									</div>

									<div class="col-6">
										<label for="uf_profissional">UF</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker"></i></span></div>
											<input required type="text" class="form-control" id="uf_profissional" name="uf_profissional" placeholder="UF" value="<?=$pro['uf_profissional']?>">
										</div>
									</div>
								</div>

								<hr class="mb-4">

								<div class="row">
									<div class="col-6">
										<label for="email_profissional">E-mail</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-at"></i></span></div>
											<input required type="email" class="form-control" id="email_profissional" name="email_profissional" placeholder="Email" value="<?=$pro['email_profissional']?>">
										</div>
									</div>

									<div class="col-6">
										<label for="pass_profissional">Senha</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-asterisk"></i></span></div>
											<input type="password" class="form-control" id="pass_profissional" name="pass_profissional" placeholder="Senha" value="">
										</div>
									</div>

									<div class="col-12 pt-2">
										<button class="btn btn-success mb-3">Editar</button>
									</div>
								</div>

								<input type="hidden" name="id" value="<?=$pro['id']?>">
								<?php endforeach; ?>
							</form>
						</div>
					</div>
				</div>
			</div>

			<?php include_once 'estatico/rodape.php'; ?>
		</div>
	</body>
</html>
