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
											<h5 class="card-title text-uppercase text-muted font-weight-normal mb-0">Produtos fora de estoque</h5>
											<span class="h2 font-weight-bold mb-0">
												<?php
													foreach($estoque->contarForaDeEstoque() as $ce):
														echo $ce['total'];
													endforeach;
												?>
											</span>
										</div>

										<div class="col-auto text-right">
											<div class="icone-container bg-danger text-white rounded-circle float-right">
												<i class="fa fa-times"></i>
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
								Produtos
								<a href="produtosAdd.php" class="btn btn-success btn-sm float-right">Cadastrar produto</a>
							</h3>
						</div>

						<div class="table-responsive">
							<table class="table table-hover align-items-center table-flush">
								<thead class="thead-light">
									<tr>
									<th scope="col">#</th>
									<th scope="col">Nome</th>
									<th scope="col">Valor de compra</th>
									<th scope="col">Qtd. em Estoque</th>
									<th scope="col">Categoria</th>
									<th scope="col">Ações</th>
									</tr>
								</thead>

								<tbody>
									<?php foreach($crud->listarTudo("tb_estoque_produto") as $pro): ?>
									<tr>
										<th style="width: 50px;" scope="row"><b><?php echo $pro['id']; ?></b></th>
										<td><?php echo $pro['nm_prod']; ?></td>
										<td>R$ <?php echo $pro['vl_prod']; ?></td>
										<td><?php echo $pro['quant_prod']; ?></td>
										<td><?php echo $pro['cat_prod']; ?></td>
										<td style="width: 250px;">
											<form class="d-inline" method="GET" action="planosEdit.php">
												<input type="hidden" name="id" value="<?=$pro['id']?>">
												<button class="btn btn-primary btn-sm mr-2"><i class="fa fa-plus"></i></button>
											</form>

											<form class="d-inline" method="GET" action="planosEdit.php">
												<input type="hidden" name="id" value="<?=$pro['id']?>">
												<button class="btn btn-danger btn-sm mr-2"><i class="fa fa-minus"></i></button>
											</form>

											<form class="d-inline" method="GET" action="produtosHistorico.php">
												<input type="hidden" name="id" value="<?=$pro['id']?>">
												<button class="btn btn-secondary btn-sm"><i class="fa fa-file-o"></i> Histórico</button>
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
