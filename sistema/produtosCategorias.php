<?php
require '../controller/verLogado.php';

include_once '../model/Conexao.class.php';
include_once '../model/Crud.class.php';
include_once '../model/Estoque.class.php';

$crud = new Crud();
$estoque = new Estoque();
?>

<!DOCTYPE html>

<html lang="pt-br">
	<?php include_once 'estatico/head.php'; ?>

	<body class="painel">
		<?php include_once 'estatico/menu.php'; ?>

		<div class="conteudo">
			<?php include_once 'estatico/breadcrumbs.php'; ?>

			<!-- AREA DESTAQUES -->
			<div class="container-fluid">
				<div class="destaques py-4">
					<div class="row">
						<div class="col-6">
							<div class="card shadow">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title text-uppercase text-muted font-weight-normal mb-0">Total de Produtos</h5>
											<span class="h2 font-weight-bold mb-0">
												<?php
													foreach($crud->contarTudo("tb_estoque_produto") as $ce):
														echo $ce['total'];
													endforeach;
												?>
											</span>
										</div>

										<div class="col-auto text-right">
											<div class="icone-container bg-primary text-white rounded-circle float-right">
												<i class="fa fa-archive"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-6">
							<div class="card shadow">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title text-uppercase text-muted font-weight-normal mb-0">Total de categorias</h5>
											<span class="h2 font-weight-bold mb-0">
												<?php
													foreach($crud->contarTudo('tb_estoque_produto_categoria') as $ce):
														echo $ce['total'];
													endforeach;
												?>
											</span>
										</div>

										<div class="col-auto text-right">
											<div class="icone-container bg-primary text-white rounded-circle float-right">
												<i class="fa fa-check"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<!-- AREA LISTAGEM -->
			<div class="container-fluid">
				<div class="listagem py-3">
					<div class="card shadow">
						<div class="card-header border-0">
							<h3 class="mb-0">
								Categorias de produtos
								<a href="produtosCategoriasAdd.php" class="btn btn-success btn-sm float-right">Cadastrar categoria</a>
							</h3>
						</div>

						<div class="table-responsive">
							<table class="table table-hover align-items-center table-flush">
								<thead class="thead-light">
									<tr>
									<th scope="col">#</th>
									<th scope="col">Nome</th>
									<th scope="col">Ações</th>
									</tr>
								</thead>

								<tbody>
									<?php foreach($crud->listarTudo("tb_estoque_produto_categoria") as $pro): ?>
									<tr>
										<th style="width: 50px;" scope="row"><b><?php echo $pro['id']; ?></b></th>
										<td><?php echo $pro['nm_produto_categoria']; ?></td>
										<td style="width: 150px;">
											<form class="d-inline" method="GET" action="produtosCategoriasEdit.php">
												<input type="hidden" name="id" value="<?=$pro['id']?>">
												<button class="btn btn-success btn-sm mr-2"><i class="fa fa-pencil"></i></button>
											</form>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<?php include_once 'estatico/rodape.php'; ?>
		</div>
	</body>
</html>
