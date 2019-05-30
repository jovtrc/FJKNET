<?php
require '../controller/verLogado.php';

include_once '../model/Conexao.class.php';
include_once '../model/Crud.class.php';
include_once '../model/Cliente.class.php';
include_once '../model/Chamado.class.php';

$crud = new Crud();
$cliente = new Cliente();
$chamado = new Chamado();

if (isset($_GET['id']) && $_GET['id'] != "" ) {
	$idServico = $_GET['id'];
} else {
?>
<script>
	$(document).ready(function() {
		setTimeout(function(){
			closeWin()
		}, 4000);
	});

	function closeWin() {
		window.top.close();
	}
</script>

<?php
echo "<div class=\"alert alert-danger m-5 p-5\"><h1>ID do serviço não encontrado!</h1></div>";
echo "<style>.areaServico { display: none; }";
}
?>

<!DOCTYPE html>

<html lang="pt-br">
	<?php include_once 'estatico/head.php'; ?>

	<body class="painel">
		<a href="chamados.php" class="btn btn-lg btn-primary my-5 btn-block m">Voltar</a>
    <div class="areaServico">
	<?php


		foreach($chamado->exibirChamadoCompleto($idServico) as $item) {
			$dataServico = strtotime($item["dt_servico"]);
			$dataInstalacao = strtotime($item["inst_cliente"]);

			$nomeTecnico = $item["Tecnico"];
			$nomeAssinante = $item["nm_cliente"];
	?>
		<div class="topo py-1 px-4">
			<div class="row">
				<div class="col-7 resumoEmpresa">
					<p>Rua Araguaia Feitosa Martins, N.169. São Paulo - SP<br>
					Telefone: (11) 4113-6571 - Cep: 02317-000 - São Paulo / SP</p>
				</div>

				<div class="col-5 text-right resumoChamado">
					<div class="areaQr">
						<?php
							$aux = 'qr_img0.50j/php/qr_img.php?';
							$aux .= 'e=L&';
							$aux .= 's=4&';
							$aux .= 't=P&';
							$aux .= 'd=https://' . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI];
						?>

						<img src="<?php echo $aux; ?>" class="qrcode"/>
					</div>
					<p>Chamado de Instalação - <b>#<?php echo $idServico; ?></b></p>
				</div>
			</div>
		</div>

		<?php if($item["id_status_servico"] == 2) { ?>
			<div class="pt-3">
				<div class="alert alert-success text-center p-2 m-0">Serviço finalizado!</div>
			</div>
		<?php } ?>

		<hr>

		<div class="chamado pt-3 pb-2 px-4 mt-3">
			<div class="form-row">
				<div class="col-12 col-md-6">
					<div class="card">
						<div class="card-header"><i class="fa fa-support"></i> Informações do Chamado</div>

						<div class="informacoes">
							<ul class="list-unstyled m-0">
								<li>Aberto por:<b> <?php echo ucwords(strtolower($item["Abre"])); ?></b></li>
								<li>Data da abertura:<b> <?php echo date('d/m/Y H:i:s', $dataServico); ?></b></li>
								<li>Tipo de chamado:<b> <?php echo $item["nm_tipo_servico"]; ?></b></li>
								<li>Descrição do chamado:<b> <?php echo $item["ds_servico"]; ?></b></li>
								<li>Técnico responsável:<b> <?php echo ucwords(strtolower($item["Tecnico"])); ?></b></li>
								<li>CTO:<b> <?php echo $item["cto_cliente"]; ?></b> | PORTA: <b><?php echo $item["porta_cliente"]; ?></b></li>
								<li>Login:<b> <?php echo $item["login_cliente"]; ?></b> | Senha:<b> <?php echo $item["pass_cliente"]; ?></b></li>
								<li>MAC:<b> <?php echo $item["mac_cliente"]; ?></b></li>
								<li>IP:<b> <?php echo $item["ip_cliente"]; ?></b></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-12 col-md-6 infoAssinante">
					<div class="card">
						<div class="card-header"><i class="fa fa-user"></i> Informações do Assinante</div>

						<div class="informacoes">
							<ul class="list-unstyled m-0">
								<li>Cliente:<b> <?php echo ucwords(strtolower($item["nm_cliente"])); ?></b></li>
								<li>Endereço:<b> <?php echo $item["rua_cliente"]; ?>, <?php echo $item["nr_cliente"]; ?> - <?php echo $item["br_cliente"]; ?></b></li>
								<li>CEP:<b> <?php echo $item["cep_cliente"]; ?> - <?php echo $item["cid_cliente"]; ?>/<?php echo $item["uf_cliente"]; ?></b></li>
								<li>Complemento:<b> <?php echo $item["compl_cliente"]; ?></b></li>
								<li>Telefones:<b> <?php echo $item["tel_cliente"]; ?> / <?php echo $item["cel_cliente"]; ?></b></li>
								<li>Telefone Comercial:<b> <?php echo $item["telc_cliente"]; ?></b></li>
								<li>Instalado por:<b> <?php echo ucwords(strtolower($item["Instalador"])); ?></b></li>
								<li>Data da instalação:<b> <?php echo date('d/m/Y', $dataInstalacao); ?></b></li>
								<li>Plano:<b> <?php echo $item["nm_plano"]; ?></b> | Contrato:<b> <?php echo $item["contrato_cliente"]; ?></b></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php if($item["id_status_servico"] == 2) {
			foreach($chamado->exibirRegistroAtendimento($idServico) as $atend) {
				$dataInicio = strtotime($atend["inicio_atend_servico"]);
				$dataFim = strtotime($atend["fim_atend_servico"]);
				$dataPag = strtotime($atend["dt_pag_servico"]); ?>

				<div id="parteAtendimento">
					<div class="atendimento py-2 px-4">
						<div class="card">
							<div class="card-header"><i class="fa fa-exclamation-circle"></i> Registro de Atendimento</div>

							<div class="informacoes">
								<ul class="list-unstyled m-0">
									<li class="p-3">
										<b>Atendimento iniciado:</b> <?php echo $atend["realiz_atend_servico"]; ?> -
										<b>Motivo: </b> <?php echo $atend["motivo_atend_servico"]; ?> -
										<b>Início do atendimento:</b> <?php echo date('d/m/Y H:i:s', $dataInicio); ?> </li>
								</ul>
							</div>
						</div>
					</div>

					<?php if ($atend["realiz_atend_servico"] == "Não") { } else { ?>
						<div class="atendimento py-2 px-4">
							<div class="card">
								<div class="card-header"><i class="fa fa-check"></i> Finalização do Chamado - <b>#<?php echo $idServico; ?></b></div>

								<div class="informacoes">
									<ul class="list-unstyled m-0">
										<li class="px-3 py-3">
											<b>Relato do técnico:</b> <?php echo $atend["relato_servico"]; ?>
										</li>

										<li class="px-3">
											<b>Up:</b> <?php echo $atend["up_servico"]; ?>
											<b>Down:</b> <?php echo $atend["down_servico"]; ?>
											<b>CTO:</b> <?php echo $atend["cto_servico"]; ?>
											<b>Porta:</b> <?php echo $atend["porta_servico"]; ?>
											<b>Sinal:</b> <?php echo $atend["sinal_servico"]; ?>
										</li> <hr>

										<li class="px-3 pb-3"><b>Data e hora da finalização do atendimento:</b> <?php echo date('d/m/Y H:i:s', $dataFim); ?> </li>

										<li class="px-3 pb-3">
											<b>Resolveu o problema:</b> <?php echo $atend["resolveu_servico"]; ?> -
											<b>Motivo: </b> <?php echo $atend["motivo_resolveu_servico"]; ?> -
											<b>Agendar novo atendimento:</b> <?php echo $atend["agendar_servico"]; ?>
										</li>

										<li class="px-3 pb-3">
											<b>Atendimento gratuito:</b> <?php echo $atend["gratis_servico"]; ?> -
											<b>Valor: R$</b><?php echo $atend["vl_servico"]; ?>
										</li>

										<li class="px-3 pb-3">
											<b>Pagamento efetuado:</b> <?php echo $atend["pag_servico"]; ?> -
											<b>Data do pagamento:</b> <?php echo date('d/m/Y', $dataPag); ?> -
											<b>Observação  pagamento:</b> <?php echo $atend["obs_pag_servico"]; ?>
										</li>
									</ul>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			<?php }
		} else { ?>
			<div id="parteAtendimento">
				<div class="atendimento py-2 px-4">
					<div class="card">
						<div class="card-header"><i class="fa fa-exclamation-circle"></i> Registro de Atendimento</div>

						<div class="informacoes">
							<ul class="list-unstyled m-0">
								<li class="p-3">
									<b>Atendimento iniciado:</b> (   ) Sim  (   ) Não -
									<b>Motivo: </b> ___________________ -
									<b>Início do atendimento:</b> _____ / _____ / ________  -  _____ : _____ </li>
							</ul>
						</div>
					</div>
				</div>

				<div class="atendimento py-2 px-4">
					<div class="card">
						<div class="card-header"><i class="fa fa-check"></i> Finalização do Chamado - <b>#<?php echo $idServico; ?></b></div>

						<div class="informacoes">
							<ul class="list-unstyled m-0">
								<li class="px-3 py-3">
									<b>Relato do técnico:</b> _____________________________________________________________________________________________________________________
								</li>

								<li class="px-3">
									<b>Up:</b> __________  <b>Down:</b> __________  <b>CTO:</b> ___________  <b>Porta:</b> ___________ <b>Sinal:</b> ___________
								</li> <hr>

								<li class="px-3 pb-3"><b>Data e hora da finalização do atendimento:</b> ______ / ______ / _________  -  ______ : ______ </li>
								<li class="px-3 pb-3">
									<b>Resolveu o problema:</b> (   ) Sim  (   ) Não -
									<b>Motivo: </b> ________________________________ -
									<b>Agendar novo atendimento:</b> (   ) Sim  (   ) Não
								</li>

								<li class="px-3 pb-3"><b>Atendimento gratuito:</b> (   ) Sim  (   ) Não - <b>Valor: R$</b>________________________________________</li>
								<li class="px-3 pb-3">
									<b>Pagamento efetuado:</b> (   ) Sim  (   ) Não -
									<b>Data do pagamento:</b> _____ / _____ / ________ -
									<b>Observação  pagamento:</b> _____________________
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>

		<div class="assinatura pt-4 px-4 mt-2">
			<div class="row text-center">
				<div class="col-12 col-md-6 assinaturaTecnico">
					<p>_________________________________________________________________</p>
					<p><b>Técnico Responsável</b></p>
					<p><?php echo ucwords(strtolower($nomeTecnico)); ?></p>
				</div>

				<div class="col-12 col-md-6 assinaturaAssinante">
					<p>_________________________________________________________________</p>
					<p><b>Titular/Responsável</b></p>
					<p><?php echo ucwords(strtolower($nomeAssinante)); ?></p>
				</div>
			</div>
		</div>
	<?php } ?>
</div>




<style>
	p { margin-bottom: 5px; }
	#conteudo { width: 100%;}
  body { background: white; }
	.mainHead, #sidebar { display: none; }

	.logoPadrao {
		float: left;
		max-height: 60px;
	}

	.resumoEmpresa p {
		font-size: 12px;
		margin-bottom: 0;
		float: left;
		padding: 12px 0 12px 15px;
	}

	.resumoChamado p {
		float: right;
		margin: 21px 10px 0 0;
	}

	.areaQr {
		width: 60px;
		height: 60px;
		float: right;
		background: black;
	}

	.qrcode {
		max-width: 70px;
		margin: -5px 0 0 -5px;
	}

	.informacoes {
		font-size: 14px;
	}

	.chamado .informacoes li {
		padding: 12px 15px;
		border-bottom: 1px solid #d8d8d8;
	}

	.chamado .informacoes li:last-child {
		border-bottom: 0;
	}
</style>

	</body>
</html>
