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
								Cadastrar Produto
								<a href="produtos.php" class="btn btn-danger btn-sm float-right">Cancelar</a>
							</h3>
						</div>

						<div class="card-body">
							<form method="POST" action="../controller/produtosAdd.php">
								<div class="row">
									<div class="col-12 col-md-6">
										<label class="requerido" for="nm_prod">Nome do produto</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-o"></i></span></div>
											<input required type="text" class="form-control" id="nm_prod" name="nm_prod" placeholder="Exemplo: Roteador Wifi" value="">
										</div>
									</div>

									<div class="col-12 col-md-6">
										<label class="requerido" for="vl_prod">Valor de compra</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-dollar"></i></span></div>
											<input required type="text" class="form-control" id="vl_prod" name="vl_prod" placeholder="Exemplo: 50" value="">
										</div>
									</div>

									<div class="col-12 col-md-6">
										<label class="requerido" for="quant_prod">Quantidade em estoque</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-archive"></i></span></div>
											<input required type="text" class="form-control" id="quant_prod" name="quant_prod" placeholder="Exemplo: 5" value="">
										</div>
									</div>

									<div class="col-12 col-md-6">
										<label class="requerido" for="cat_prod">Categoria</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-pencil"></i></span></div>
											<select required class="form-control" id="cat_prod" name="cat_prod">
												<option value="">Selecione</option>
												<?php foreach($crud->listarTudo("tb_estoque_produto_categoria") as $pro): ?>
													<option value="<?php echo $pro['id']; ?>"><?php echo $pro['nm_produto_categoria']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

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
