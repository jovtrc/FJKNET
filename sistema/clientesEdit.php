<?php
require '../controller/verLogado.php';

include_once '../model/Conexao.class.php';
include_once '../model/Crud.class.php';
include_once '../model/Cliente.class.php';

$crud = new Crud();
$cliente = new Cliente();

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
								Editar cliente
								<a href="clientes.php" class="btn btn-danger btn-sm float-right">Cancelar</a>
							</h3>
						</div>

						<div class="card-body">
							<form method="POST" action="../controller/clientesEdit.php">
								<?php
									foreach($cliente->listarUmCliente($id) as $pro):
									$dsIsento = ($pro['isento_cliente'] === 1) ? 'Não' : 'Sim';
								?>
								<div class="card mb-4">
									<div class="card-header"><p class="card-title font-weight-bold mb-0">Informações do cliente</p></div>

									<div class="card-body">
										<div class="areaPessoa row">
											<div class="col-12 col-md-3">
												<label for="pessoaSelect" class="requerido">Pessoa</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
													<select id="pessoaSelect" name="pessoa_cliente" class="form-control" required="" onchange="mudaPessoa()">
														<option value="<?=$pro['pessoa_cliente']?>"><?=$pro['pessoa_cliente']?></option>
														<option value="">---</option>
														<option value="Física">Física</option>
														<option value="Jurídica">Jurídica</option>
													</select>
												</div>
											</div>

											<div class="col-12 col-md-3">
												<div class="fisica">
													<label for="rgInput">RG</label>
													<div class="input-group mb-4">
														<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-text-o"></i></span></div>
														<input id="rgInput" name="rg_cliente" class="form-control" value="<?=$pro['rg_cliente']?>"placeholder="Exemplo: 15147386190" type="text">
													</div>
												</div>

												<div class="juridica" style="display: none;">
													<label for="ieInput">IE</label>
													<div class="input-group mb-4">
														<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-text-o"></i></span></div>
														<input id="ieInput" name="ie_cliente" class="form-control" value="<?=$pro['ie_cliente']?>"placeholder="Exemplo: 15147386190" type="text">
													</div>
												</div>
											</div>

											<div class="col-12 col-md-3">
												<div class="fisica">
													<label for="cpfInput" class="requerido">CPF</label>
													<div class="input-group mb-4">
														<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-text-o"></i></span></div>
														<input id="cpfInput" name="cpf_cliente" class="form-control" value="<?=$pro['cpf_cliente']?>"placeholder="Exemplo: 15147386190" type="text">
													</div>
												</div>

												<div class="juridica" style="display: none;">
													<label for="cnpjInput" class="requerido">CNPJ</label>
													<div class="input-group mb-4">
														<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-file-text-o"></i></span></div>
														<input id="cnpjInput" name="cnpj_cliente" class="form-control" value="<?=$pro['cnpj_cliente']?>"placeholder="Exemplo: 65622945000190" type="text">
													</div>
												</div>
											</div>

											<div class="col-12 col-md-3">
												<label for="statusSelect" class="requerido">Status</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-check"></i></span></div>
													<select id="statusSelect" name="status_cliente" class="form-control" required="">
														<option value="<?=$pro['status_cliente']?>"><?=$pro['ds_status_cliente']?></option>
														<option value="">---</option>
														<?php
															foreach($crud->listarTudo("tb_cliente_status") as $ce):
																echo '<option value="' . $ce['id'] . '">' . $ce['ds_status_cliente'] . '</option>';
															endforeach;
														?>
													</select>
												</div>
											</div>

											<div class="col-12 col-md-4">
												<label for="nomeInput" class="requerido">Nome</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
													<input id="nomeInput" name="nm_cliente" class="form-control" value="<?=$pro['nm_cliente']?>"placeholder="Exemplo: Carlos Vieira" required="" type="text">
												</div>
											</div>

											<div class="col-12 col-md-4">
												<label for="nascInput" class="requerido">Data de nascimento</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
													<input id="nascInput" name="nascimento_cliente" class="form-control" value="<?=$pro['nascimento_cliente']?>"placeholder="Exemplo: 17/02/1998" required="" type="date">
												</div>
											</div>

											<div class="col-12 col-md-4">
												<label for="generoSelect" class="requerido">Gênero</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
													<select id="generoSelect" name="sexo_cliente" class="form-control" required="">
														<option value="<?=$pro['sexo_cliente']?>"><?=$pro['sexo_cliente']?></option>
														<option value="">---</option>
														<option value="Masculino">Masculino</option>
														<option value="Feminino">Feminino</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="card mb-4">
									<div class="card-header"><p class="card-title font-weight-bold mb-0">Contatos</p></div>

									<div class="card-body">
										<div class="areaContato row">
											<div class="col-12 col-md-3">
												<label for="telInput" class="requerido">Telefone</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
													<input id="telInput" name="tel_cliente" class="form-control" value="<?=$pro['tel_cliente']?>"placeholder="Exemplo: (11) 3457-5689" type="text">
												</div>
											</div>

											<div class="col-12 col-md-3">
												<label for="telcInput">Telefone comercial</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
													<input id="telcInput" name="telc_cliente" class="form-control" value="<?=$pro['telc_cliente']?>"placeholder="Exemplo: (11) 3457-5689" type="text">
												</div>
											</div>

											<div class="col-12 col-md-3">
												<label for="celInput">Celular</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-mobile"></i></span></div>
													<input id="celInput" name="cel_cliente" class="form-control" value="<?=$pro['cel_cliente']?>"placeholder="Exemplo: (11) 95876-5689" type="text">
												</div>
											</div>

											<div class="col-12 col-md-3">
												<label for="emailInput">Email</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-envelope"></i></span></div>
													<input id="emailInput" name="email_cliente" class="form-control" value="<?=$pro['email_cliente']?>"placeholder="Exemplo: (11) 95876-5689" type="text">
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="card mb-4">
									<div class="card-header"><p class="card-title font-weight-bold mb-0">Endereço</p></div>

									<div class="card-body">
										<div class="areaEndereco row">
											<div class="col-12 col-md-3">
												<label for="cepInput" class="requerido">CEP</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker"></i></span></div>
													<input id="cepInput" name="cep_cliente" class="form-control" value="<?=$pro['cep_cliente']?>"placeholder="Exemplo: 02310000" required="" type="text" onkeyup="if(this.value.length >= 8) { $('#ruanrInput').focus(); }">
													<input id="ibgeInput" class="form-control" value="" type="hidden">
												</div>
											</div>

											<div class="col-12 col-md-3">
												<label for="ruaInput" class="requerido">Rua</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker"></i></span></div>
													<input id="ruaInput" name="rua_cliente" class="form-control" value="<?=$pro['rua_cliente']?>"placeholder="Completa ao preencher CEP" required="" type="text">
												</div>
											</div>

											<div class="col-12 col-md-3">
												<label for="ruanrInput" class="requerido">Número</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker"></i></span></div>
													<input id="ruanrInput" name="nr_cliente" class="form-control" value="<?=$pro['nr_cliente']?>"placeholder="Exemplo: 95" required="" type="text">
												</div>
											</div>

											<div class="col-12 col-md-3">
												<label for="bairroInput" class="requerido">Bairro</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker"></i></span></div>
													<input id="bairroInput" name="br_cliente" class="form-control" value="<?=$pro['br_cliente']?>"placeholder="Completa ao preencher CEP" required="" type="text">
												</div>
											</div>

											<div class="col-12 col-md-4">
												<label for="complInput">Complemento</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker"></i></span></div>
													<input id="complInput" name="compl_cliente" class="form-control" value="<?=$pro['compl_cliente']?>"placeholder="Exemplo: Casa 2" type="text">
												</div>
											</div>

											<div class="col-12 col-md-4">
												<label for="cidadeInput" class="requerido">Cidade</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker"></i></span></div>
													<input id="cidadeInput" name="cid_cliente" class="form-control" value="<?=$pro['cid_cliente']?>"placeholder="Completa ao preencher CEP" required="" type="text">
												</div>
											</div>

											<div class="col-12 col-md-4">
												<label for="ufInput" class="requerido">UF</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker"></i></span></div>
													<input id="ufInput" name="uf_cliente" class="form-control" value="<?=$pro['uf_cliente']?>"placeholder="Completa ao preencher CEP" required="" type="text">
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="card mb-4">
									<div class="card-header"><p class="card-title font-weight-bold mb-0">Plano</p></div>

									<div class="card-body">
										<div class="areaPlano row">
											<div class="col-12 col-md-4">
												<label for="planoSelect" class="requerido">Plano</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-globe"></i></span></div>
													<select id="planoSelect" name="plano_cliente" class="form-control" required="">
														<option value="<?=$pro['plano_cliente']?>"><?=$pro['nm_plano']?></option>
														<option value="">---</option>
														<?php
															foreach($crud->listarTudo("tb_cliente_planos") as $ce):
																echo '<option value="' . $ce['id'] . '">' . $ce['nm_plano'] . '</option>';
															endforeach;
														?>
													</select>
												</div>
											</div>

											<div class="col-md-2">
												<label for="diaVencInput" class="requerido">Dia do vencimento</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-calendar"></i></span></div>
													<input id="diaVencInput" name="vencimento_cliente" class="form-control" value="<?=$pro['vencimento_cliente']?>"placeholder="Exemplo: 25" required="" type="number">
												</div>
											</div>

											<div class="col-md-2">
												<label for="isentoSelect" class="requerido">Isento</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-dollar"></i></span></div>
													<select id="isentoSelect" name="isento_cliente" class="form-control" required="">
														<option value="<?=$pro['isento_cliente']?>"><?=$dsIsento?></option>
														<option value="">---</option>
														<option value="0">Sim</option>
														<option value="1">Não</option>
													</select>
												</div>
											</div>

											<div class="col-md-2">
												<label for="loginInput" class="requerido">Login</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
													<input id="loginInput" name="login_cliente" class="form-control" value="<?=$pro['login_cliente']?>"placeholder="Exemplo: jose@provedor" required="" type="text">
												</div>
											</div>

											<div class="col-md-2">
												<label for="senhaInput" class="requerido">Senha</label>
												<div class="input-group mb-4">
													<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-asterisk"></i></span></div>
													<input id="senhaInput" name="pass_cliente" class="form-control" value="<?=$pro['pass_cliente']?>"placeholder="Exemplo: 123" required="" type="text">
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="card mb-4 d-none">
									<div class="card-header"><p class="card-title font-weight-bold mb-0">Rede</p></div>

									<div class="card-body">
										<div class="areaRede row">
											<div class="col-12 col-md-4">
												<div class="input-group mb-4">
													<label for="ipInput">IP</label>
													<input id="ipInput" name="ip_cliente" class="form-control" value="<?=$pro['ip_cliente']?>"placeholder="Exemplo: 127.0.0.1" type="text">
												</div>
											</div>

											<div class="col-12 col-md-4">
												<div class="input-group mb-4">
													<label for="macInput">MAC</label>
													<input id="macInput" name="mac_cliente" class="form-control" value="<?=$pro['mac_cliente']?>"placeholder="Exemplo: 00:0a:95:9d:68:16" type="text">
												</div>
											</div>

											<div class="col-12 col-md-4">
												<div class="input-group mb-4">
													<label for="authSelect">Autenticação</label>
													<select id="authSelect" name="auth_cliente" class="form-control">
														<option value="">Selecione</option>
														<option value="PPOE">PPOE</option>
													</select>
												</div>
											</div>

											<div class="col-12 col-md-3">
												<div class="input-group mb-4">
													<label for="radioInput">Rádio</label>
													<input id="radioInput" name="radio_cliente" class="form-control" value="<?=$pro['radio_cliente']?>"placeholder="" type="text">
												</div>
											</div>

											<div class="col-12 col-md-3">
												<div class="input-group mb-4">
													<label for="repetidoraInput">Repetidora</label>
													<input id="repetidoraInput" name="repetidora_cliente" class="form-control" value="<?=$pro['nm_paciente']?>"placeholder="" type="text">
												</div>
											</div>

											<div class="col-12 col-md-3">
												<div class="input-group mb-4">
													<label for="ctoInput">CTO</label>
													<input id="ctoInput" name="cto_cliente" class="form-control" value="<?=$pro['cto_cliente']?>"placeholder="" type="text">
												</div>
											</div>

											<div class="col-12 col-md-3">
												<div class="input-group mb-4">
													<label for="portaInput">Porta</label>
													<input id="portaInput" name="porta_cliente" class="form-control" value="<?=$pro['porta_cliente']?>"placeholder="" type="text">
												</div>
											</div>
										</div>
									</div>
								</div>

								<input type="hidden" name="id" value="<?=$pro['id']?>">

								<div class="row">
									<div class="col-12 pt-2">
										<button class="btn btn-success mb-3">Editar</button>
									</div>
								</div>
							<?php endforeach; ?>
							</form>
						</div>
					</div>
				</div>
			</div>

			<?php include_once 'estatico/rodape.php'; ?>

			<script src="assets/js/buscacep.js"></script>

			<script>
				function mudaPessoa() {
					var pessoaSelect = $("#pessoaSelect");
					var contentFisico = $(".fisica");
					var contentJuridico = $(".juridica");

					var rgInput = $("#rgInput");
					var cpfInput = $("#cpfInput");

					var ieInput = $("#ieInput");
					var cnpjInput = $("#cnpjInput");

					if (pessoaSelect.val() == "Física") {
						contentFisico.show();
						contentJuridico.hide();

						ieInput.val("");
						cnpjInput.val("");
					} else if (pessoaSelect.val() == "Jurídica") {
						contentJuridico.show();
						$(".fisica").hide();

						rgInput.val("");
						cpfInput.val("");
					}
				}
			</script>
		</div>
	</body>
</html>
