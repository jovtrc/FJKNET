<?php require '../controller/verLogado.php'; ?>

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
								Cadastrar Categoria
								<a href="produtosCategorias.php" class="btn btn-danger btn-sm float-right">Cancelar</a>
							</h3>
						</div>

						<div class="card-body">
							<form method="POST" action="../controller/produtosCategoriasAdd.php">
								<div class="row">
									<div class="col-12">
										<label class="requerido" for="nm_produto_categoriauto_categoria">Nome da categoria</label>
										<div class="input-group mb-4">
											<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-o"></i></span></div>
											<input required type="text" class="form-control" id="nm_produto_categoria" name="nm_produto_categoria" placeholder="Exemplo: Roteadores" value="">
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
