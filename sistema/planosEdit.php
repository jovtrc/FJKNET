<?php
require '../controller/verLogado.php';

include_once '../model/Conexao.class.php';
include_once '../model/Crud.class.php';

$crud = new Crud();

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
								Editar Plano
								<a href="planos.php" class="btn btn-danger btn-sm float-right">Cancelar</a>
							</h3>
						</div>

						<div class="card-body">
							<form method="POST" action="../controller/planosEdit.php">
								<?php foreach($crud->pegarInfos("tb_cliente_planos", $id) as $pro): ?>

								<div class="row">
									<div class="col-6">
										<label class="requerido" for="nm_plano">Nome</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-o"></i></span></div>
											<input required type="text" class="form-control" id="nm_plano" name="nm_plano" placeholder="Nome do Plano" value="<?=$pro['nm_plano']?>">
										</div>
									</div>

									<div class="col-6">
										<label class="requerido" for="vl_plano">Valor</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-dollar"></i></span></div>
											<input required type="text" class="form-control" id="vl_plano" name="vl_plano" placeholder="Valor do plano" value="<?=$pro['vl_plano']?>">
										</div>
									</div>

									<div class="col-6">
										<label class="requerido" for="down_plano">Download</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-arrow-down"></i></span></div>
											<input required type="text" class="form-control" id="down_plano" name="down_plano" placeholder="Download em KBPS" value="<?=$pro['down_plano']?>">
										</div>
									</div>

									<div class="col-6">
										<label class="requerido" for="up_plano">Upload</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-arrow-up"></i></span></div>
											<input required type="text" class="form-control" id="up_plano" name="up_plano" placeholder="Upload em KBPS" value="<?=$pro['up_plano']?>">
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
