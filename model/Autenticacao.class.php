<?php

// Classe que faz verificação de autenticação e sessões
class Autenticacao extends Conexao {
	public function login($email, $password) {
		$pdo = parent::get_instance();
		$sql = "SELECT * FROM tb_profissionais WHERE email_profissional = :email AND pass_profissional = :password";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":password", $password);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$id = $sql['id'];
			$nome = $sql['nm_profissional'];
			$tipo = $sql['id_profissional_tipo'];

			$_SESSION['FJK_id'] = $id;
			$_SESSION['FJK_nome'] = $nome;
			$_SESSION['FJK_tipo'] = $tipo;

			header("Location: ../sistema/index.php?login_success");
		} else {
			echo "<script>alert('Usuário/senha incorretos'); window.location = '../index.php';</script>";
		}
	}

	public function logout() {
		unset($_SESSION['FJK_id']);

		header("Location: ../index.php?session_ending_success");
	}
}

?>
