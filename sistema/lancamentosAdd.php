<?php
require '../controller/verLogado.php';

include_once '../model/Conexao.class.php';
include_once '../model/Crud.class.php';

$crud = new Crud();
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
								Cadastrar Plano
								<a href="lancamentos.php" class="btn btn-danger btn-sm float-right">Cancelar</a>
							</h3>
						</div>

						<div class="card-body">
							<form method="POST" action="../controller/lancamentosAdd.php">
								<div class="row">
									<div class="col-12 col-md-6">
										<label class="requerido" for="tp_lancamento">Tipo</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-money"></i></span></div>
												<select required name="tp_lancamento" id="tp_lancamento" class="form-control edit-input tipo-select">
													<option value="" selected="selected">Selecione</option>
													<option value="Entrada">Entrada</option>
													<option value="Saída">Saída</option>
												</select>
										</div>
									</div>

									<div class="col-12 col-md-6">
										<label class="requerido" for="cat_lancamento">Categoria</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-o"></i></span></div>
												<select required name="cat_lancamento" id="cat_lancamento" class="form-control edit-input tipo-select">
													<option value="" selected="selected">Selecione</option>
													<?php
														foreach($crud->listarTudo("tb_financeiro_lancamentos_categorias") as $ce):
															echo '<option value="' . $ce['ds_lancamento_categoria'] . '">' . $ce['ds_lancamento_categoria'] . '</option>';
														endforeach;
													?>
												</select>
										</div>
									</div>

									<div class="col-12 col-md-6">
										<label class="requerido" for="nm_lancamento">Nome</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
											<input required type="text" class="form-control" id="nm_lancamento" name="nm_lancamento" placeholder="Nome" value="">
										</div>
									</div>

									<div class="col-12 col-md-6">
										<label class="requerido" for="vl_lancamento">Valor</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-dollar"></i></span></div>
											<input required type="text" class="form-control" id="vl_lancamento" name="vl_lancamento" placeholder="Valor do lançamento" value="">
										</div>
									</div>

									<div class="col-12">
										<label class="requerido" for="ds_lancamento">Descrição</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-o"></i></span></div>
											<textarea required class="form-control" id="ds_lancamento" name="ds_lancamento" placeholder="Descrição do lançamento"></textarea>
										</div>
									</div>

									<input type="hidden" name="dt_lancamento" value="<?php echo date('Y-m-d H:i:s'); ?>">
									<input type="hidden" name="cadastrado_por" value="<?php echo $_SESSION['FJK_id']; ?>">

									<div class="col-12 pt-2">
										<button class="btn btn-success mb-3">Cadastrar</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<?php include_once 'estatico/rodape.php'; ?>
		</div>
	</body>
</html>
