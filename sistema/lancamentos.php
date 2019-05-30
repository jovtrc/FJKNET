<?php
require '../controller/verLogado.php';

include_once '../model/Conexao.class.php';
include_once '../model/Financeiro.class.php';
include_once '../model/Crud.class.php';

$financeiro = new Financeiro();
$crud = new Crud();

$valorEntrada = 0;
$valorSaida = 0;
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
						<div class="col-12 col-md-6">
							<div class="card shadow">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title text-uppercase text-muted font-weight-normal mb-0">Total de entradas</h5>
											<span class="h2 font-weight-bold mb-0">
												<?php
													foreach($financeiro->contarPorTipo("Entrada") as $ce):
														echo $ce['total'];
													endforeach;
												?>
											</span>
										</div>

										<div class="col-auto text-right">
											<div class="icone-container bg-success text-white rounded-circle float-right">
												<i class="fa fa-dollar"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 col-md-6">
							<div class="card shadow">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title text-uppercase text-muted font-weight-normal mb-0">Total de saídas</h5>
											<span class="h2 font-weight-bold mb-0">
												<?php
													foreach($financeiro->contarPorTipo("Saída") as $ce):
														echo $ce['total'];
													endforeach;
												?>
											</span>
										</div>

										<div class="col-auto text-right">
											<div class="icone-container bg-danger text-white rounded-circle float-right">
												<i class="fa fa-dollar"></i>
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
								Lançamentos
								<?php if($_SESSION['FJK_tipo'] == "1" || $_SESSION['FJK_tipo'] == "4") { ?>
									<a href="lancamentosAdd.php" class="btn btn-success btn-sm float-right">Novo lançamento</a>
								<?php } ?>
							</h3>
						</div>

						<div class="table-responsive">
							<table class="table table-hover align-items-center table-flush">
								<thead class="thead-light">
									<tr>
									<th scope="col">#</th>
									<th scope="col">Atendente</th>
									<th scope="col">Tipo</th>
									<th scope="col">Nome</th>
									<th scope="col">Valor</th>
									<th scope="col">Categoria/Referente</th>
									<th scope="col">Data</th>
									<?php if($_SESSION['FJK_tipo'] == "1" || $_SESSION['FJK_tipo'] == "4") { ?>
									<th scope="col">Excluir</th>
									<?php } ?>
									<th scope="col" class="d-none">Ações</th>
									</tr>
								</thead>

								<tbody>
									<?php foreach($financeiro->listarTodosLancamentos() as $pro):
										$dataLancamento = date('d/m/Y H:i', strtotime($pro['dt_lancamento']));
										$corLancamento = ($pro['tp_lancamento'] === "Entrada") ? 'success' : 'danger';
									?>

										<tr>
											<th style="width: 50px;" scope="row"><b><?php echo $pro['id']; ?></b></th>
											<td><?php echo $pro['nm_profissional']; ?></td>
											<td class="text-<?php echo $corLancamento; ?>"><b><?php echo $pro['tp_lancamento']; ?></b></td>
											<td><?php echo $pro['nm_lancamento']; ?></td>
											<td>R$ <?php echo $pro['vl_lancamento']; ?></td>
											<td>
												<?php echo $pro['cat_lancamento']; ?>
												<a class="btn btn-sm btn-info float-right text-white status-icon  hint--bottom-left  hint--info" aria-label="<?php echo $pro['ds_lancamento']; ?>"><i class="fa fa-info"></i></a>
											</td>
											<td><?php echo $dataLancamento; ?></td>
											<?php if($_SESSION['FJK_tipo'] == "1" || $_SESSION['FJK_tipo'] == "4") { ?>
											<td style="width: 50px;">
												<form class="d-inline" method="POST" action="../controller/lancamentosDelete.php">
													<input type="hidden" name="id" value="<?=$pro['id']?>">
													<button class="btn btn-danger btn-sm mr-2"><i class="fa fa-times"></i></button>
												</form>
											</td>
											<?php } ?>
										</tr>
									<?php
										if ($pro['tp_lancamento'] == "Entrada") {
											$valorEntrada = $valorEntrada + $pro["vl_lancamento"];
										} else {
											$valorSaida = $valorSaida + $pro["vl_lancamento"];
										}

										endforeach;

									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="container-fluid">
				<div class="listagem py-3">
					<div class="card shadow">
						<div class="card-header border-0">
							<h3 class="mb-0">
								Resumo
							</h3>
						</div>

						<div class="table-responsive">
							<table class="table table-hover align-items-center table-flush">
								<?php
									echo '<tr>' .
										 '<th style="text-align: right; width: 80%;">Total entradas</th>' .
										 '<td>R$ ' . $valorEntrada . '</td>' .
										 '</tr>';

									echo '<tr>' .
										 '<th style="text-align: right; width: 80%;">Total saídas</th>' .
										 '<td>R$ ' . $valorSaida . '</td>' .
										 '</tr>';

									$valorFinal = $valorEntrada - $valorSaida;

									echo '<tr>' .
										 '<th style="text-align: right; width: 80%;">Total</th>' .
										 '<td>R$' . $valorFinal . '</td>' .
										 '</tr>';
								?>
							</table>
						</div>
					</div>
				</div>
			</div>

			<?php include_once 'estatico/rodape.php'; ?>
		</div>
	</body>
</html>
