<?php

include_once '../model/Conexao.class.php';
include_once '../model/Paciente.class.php';

$paciente = new paciente();


$idAgendamento 	= $_POST["idAgendamento"];
$idProfissional	= $_POST["idProfissional"];
$idPaciente 	= $_POST["idPaciente"];
$prontuario 	= $_POST["ds_prontuario"];

$pos 		 	= $_POST["pos_prescricao"];
$dos 		 	= $_POST["dos_prescricao"];
$prescricao  	= $_POST["ds_prescricao"];
$exame 		 	= $_POST["ds_exame_solic"];
$transferencia 	= $_POST["ds_transferencia"];
$alta 			= $_POST["ds_alta"];

$dataAgora = date("Y-m-d");

$paciente->finalizarConsulta($idAgendamento, $idProfissional, $idPaciente, $prontuario, $dataAgora, $prescricao, $pos, $dos, $exame, $transferencia, $alta);
header("Location: ../sistema/consultas.php?finalizado_sucesso");

?>