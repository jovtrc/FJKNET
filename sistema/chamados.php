<?php
require '../controller/verLogado.php';

include_once '../model/Conexao.class.php';
include_once '../model/Crud.class.php';
include_once '../model/Chamado.class.php';

$crud = new Crud();
$chamado = new Chamado();
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
						<div class="col-12">
							<div class="card shadow">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title text-uppercase text-muted font-weight-normal mb-0">Total de Chamados</h5>
											<span class="h2 font-weight-bold mb-0">
												<?php
													foreach($crud->contarTudo("tb_servico") as $ce):
														echo $ce['total'];
													endforeach;
												?>
											</span>
										</div>

										<div class="col-auto text-right">
											<div class="icone-container bg-primary text-white rounded-circle float-right">
												<i class="fa fa-users"></i>
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
				<div class="proximas-consultas py-3">
					<div class="card shadow">
						<div class="card-header border-0"><h3 class="mb-0">Próximos chamados</h3></div>

						<div class="table-responsive">
							<table class="table table-hover align-items-center table-flush">
								<thead class="thead-light">
									<tr>
									<th scope="col">#</th>
									<th scope="col">Cliente</th>
									<th scope="col">Técnico</th>
									<th scope="col">Aberto por</th>
									<th scope="col">Tipo</th>
									<th scope="col">Descrição</th>
									<th scope="col">Status</th>
									<th scope="col">Abertura</th>
									<th scope="col">Ver</th>
									</tr>
								</thead>

								<tbody>
									<?php foreach($chamado->listarTodosChamados() as $pro):
										$dataAgendamento = date('d/m/Y H:i', strtotime($pro['dt_servico']));
										$corStatus = ($pro['nm_status_servico'] === "Incompleto") ? 'danger' : '';
									?>

										<tr>
											<th style="width: 10px;" scope="row"><b><?php echo $pro['id']; ?></b></th>
											<td><?php echo $pro['nm_cliente']; ?></td>
											<td><?php echo $pro['Tecnico']; ?></td>
											<td><?php echo $pro['Abre']; ?></td>
											<td><?php echo $pro['nm_tipo_servico']; ?></td>
											<td><?php echo $pro['ds_servico']; ?></td>
											<td class="text-<?php echo $corStatus; ?>"><?php echo $pro['nm_status_servico']; ?></td>
											<td><b><?php echo $dataAgendamento; ?></b></td>
											<td>
												<a href="chamadosImprimir.php?id=<?=$pro['id']?>" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
												<!-- <form class="d-inline" method="GET" action="lancamentosVer.php">
													<input type="hidden" name="id" value="<?=$pro['id']?>">
													<button class="btn btn-primary btn-sm mr-2"><i class="fa fa-eye"></i></button>
												</form> -->
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
