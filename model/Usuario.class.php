<?php

// Classe com as funções para os profissionais
class Usuario extends Conexao {
    // Função de buscar todos os registros de um profissional
    public function listarUmUsuario($id) {
        $pdo = parent::get_instance();
        $sql = "SELECT p.*, t.ds_profissional_tipo FROM tb_profissionais p
                INNER JOIN tb_profissional_tipo t ON p.id_profissional_tipo = t.id
                WHERE p.id = $id";
        $statement = $pdo->query($sql);
        $statement->execute();

        if($statement->rowCount() > 0) {
            return $statement->fetchAll();
        } else {
            echo "<p style='color:#333; font-size:26px;'><b>Não encontramos registros.</b></p>";
            return $statement->fetchAll();
        }
    }


    // Função de listar todos os profissionais
    public function listarUsuarios() {
        $pdo = parent::get_instance();
        $sql = "SELECT p.*, t.ds_profissional_tipo FROM tb_profissionais p
                INNER JOIN tb_profissional_tipo t ON p.id_profissional_tipo = t.id
                ORDER BY p.id ASC";
        $statement = $pdo->query($sql);
        $statement->execute();

        if($statement->rowCount() > 0) {
            return $statement->fetchAll();
        } else {
            echo "<p style='color:#333; font-size:26px;'><b>Não encontramos registros.</b></p>";
            return $statement->fetchAll();
        }
    }

}
